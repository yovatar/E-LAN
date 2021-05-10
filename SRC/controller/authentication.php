<?php

#######################
# Router entry points #
#######################

/**
 * Handles registration requests
 * @param array $request expects $_POST containing 
 */
function controllerRegister($request)
{
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

            $password = filter_var($request["password"], FILTER_SANITIZE_STRING);
            if (empty($password)) throw new Exception("Mot de passe vide");

            if ($password != $request["passwordCheck"]) throw new Exception("Le mot de passe n'est pas identique");

            // Store in to the database

            // Login

            // Redirect
            header("Location: /home");
        } catch (Exception $e) {
            header("Location: /authentication/register?error=" . $e->getMessage());
        }
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
    $_SESSION["user"] = $user;
}

/**
 * Log user out by destroying his session
 * @return void
 */
function logout()
{
    session_destroy();
}
