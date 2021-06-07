Spruce.store('register', {
    valid: null,
    usernameValid: null,
    emailValid: null,
    passwordValid: null,
    password: null,
    confirm: null,
    /**
     * @param {string} value
     */
    set _password(value) {
        this.password = value
        this.checkValidPassword()
    },
    /**
     * @param {string} value
     */
    set _confirm(value) {
        this.confirm = value
        this.checkValidPassword()
    },
    /**
     * Check if both password match
     */
    checkValidPassword() {
        if (this.password && this.confirm) {
            this.passwordValid = this.password == this.confirm
        } else {
            this.passwordValid = null
        }
        this.checkValid()
    },
    /**
     * Check if the username is available with a post request
     * @param {string} username
     */
    checkUsername(username) {
        if (username.length) {
            $.post("/api/authentication/available/username", [{ name: "username", value: username }], (e) => {
                let response = JSON.parse(e)
                if (response.code == 200) {
                    this.usernameValid = response.data.available
                }
            })
        } else {
            this.usernameValid = null
        }
    },
    /**
     * Check if the email is available with a post request
     * @param {string} email
     */
    checkEmail(email) {
        if (email.length) {
            $.post("/api/authentication/available/email", [{ name: "email", value: email }], (e) => {
                let response = JSON.parse(e)
                if (response.code == 200) {
                    this.emailValid = response.data.available
                }
            })
        } else {
            this.emailValid = null
        }
    },
    /**
     * Check if every required values are valid
     */
    checkValid() {
        if (this.passwordValid && this.usernameValid && this.emailValid) {
            this.valid = true
        } else {
            this.valid = false
        }
    }
})