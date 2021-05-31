<?php

#######################
# Router entry points #
#######################

/**
 * Handles registration requests
 * @param array $request expects $_POST containing [username,email,lastName,firstName, password, passwordCheck]
 * @return void
 */
function controllerRegister($request)
{
    if (isAuthenticated()) {
        header("Location: /");
    } else {
        require_once("view/register.php");
        if (empty($request)) {
            // Show register form
            viewRegister();
        } else {
            // Process input
            try {
                // Input validation
                $username = filter_var($request["username"], FILTER_SANITIZE_STRING);
                if (empty($username)) throw new Exception("Nom d'utilisateur invalide");

                $email = filter_var($request["email"], FILTER_VALIDATE_EMAIL);
                if ($email === false) throw new Exception("Email invalide");

                $lastName = filter_var($request["lastName"], FILTER_SANITIZE_STRING);
                if (empty($lastName)) throw new Exception("Nom invalide");

                $firsName = filter_var($request["firstName"], FILTER_SANITIZE_STRING);
                if (empty($firsName)) throw new Exception("Prénom invalide");

                $password = $request["password"];
                if (empty($password)) throw new Exception("Mot de passe vide");

                if ($password != $request["passwordCheck"]) throw new Exception("Le mot de passe n'est pas identique");

                // Check constraints
                require_once("model/users.php");
                if (!empty(selectUserByEmail($email))) throw new Exception("Email déjà utilisé");
                if (!empty(selectUserByUsername($username))) throw new Exception("Nom d'utilisateur déjà utilisé");

                // Store in to the database
                $row = insertUser($username, $email, $lastName, $firsName, $password);
                if ($row !== true) throw new Exception("Unable to save user");

                $user = selectUserByEmail($email);
                if (empty($user)) throw new Exception("Error while retrieving user from the database");

                // Login
                login($user);

                // Redirect
                header("Location: /home");
            } catch (Exception $e) {
                header("Location: /authentication/register?error=" . $e->getMessage());
            }
        }
    }
}

/**
 * Handles login requests
 * @param array $request expects $_POST containing [email,password]
 * @return void
 */
function controllerLogin($request)
{
    if (isAuthenticated()) {
        header("Location: /");
    } else {
        require_once("view/login.php");
        if (empty($request)) {
            // Show login form
            viewLogin();
        } else {
            try {
                // Input validation
                $email = filter_var($request["email"], FILTER_VALIDATE_EMAIL);
                if (empty($email)) throw new Exception("Email invalide");

                $password = $request["password"];
                if (empty($password)) throw new Exception("Mot de passe vide");

                // Compare to database
                require_once("model/users.php");
                $user = selectUserByEmail($email);
                if (empty($user)) throw new Exception("Aucun utilisateur avec cet email");

                if (password_verify($password, $user["password"]) == false) throw new Exception("Mot de passe invalide");

                // Login
                login($user);

                // Redirect
                header("Location: /home");
            } catch (Exception $e) {
                header("Location: /authentication/login?error=" . $e->getMessage());
            }
        }
    }
}

/**
 * Handles logout requests
 * @param array $request expects $_POST containing [confirm] 
 * @return void
 */
function controllerLogout($request)
{
    if (filter_var(@$request["confirm"], FILTER_VALIDATE_BOOLEAN)) {
        logout();
        header("Location: /home");
    }
}

###########
# Helpers #
###########

/**
 * Save an user to the session
 * @param array $user user array from database
 * @return void
 */
function login($user)
{
    // get profile picture if available
    if ($user["image_id"] !== null) {
        require_once("model/images.php");
        $user["image"] = selectImageById($user["image_id"]);
    }
    // save user to session
    $_SESSION["user"] = $user;
}

/**
 * Log user out by destroying his session
 * @return bool
 */
function logout()
{
    return session_destroy();
}

/**
 * Check if the user is authenticated
 * @return bool
 */
function isAuthenticated()
{
    return !empty($_SESSION["user"]);
}

/**
 * refreshes the user session with a given email
 * @warn potentially unsafe, if you aren't sure if the email is right, use logout() and redirect the user to /authentication/login
 * @param string $email
 * @return void
 */
function refreshLogin($email)
{
    require_once("model/users.php");
    login(selectUserByEmail($email));
}