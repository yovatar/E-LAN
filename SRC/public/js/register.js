Spruce.store('register', {
    /**
     * username validation
     */
    username: {
        available: null,
        check(username) {
            if (username.length) {
                $.post("/api/authentication/available/username", [{ name: "username", value: username }], (e) => {
                    let response = JSON.parse(e)
                    if (response.code == 200) {
                        this.available = response.data.available
                    }
                })
            } else {
                this.available = null
            }
            Spruce.store("register").check()
        }
    },
    /**
     * email validation
     */
    email: {
        available: null,
        valid: null,
        check(email) {
            if (email.length) {
                if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
                    this.valid = true
                    $.post("/api/authentication/available/email", [{ name: "email", value: email }], (e) => {
                        let response = JSON.parse(e)
                        if (response.code == 200) {
                            this.available = response.data.available
                        }
                    })
                } else {
                    this.valid = false
                    this.available = null
                }
            } else {
                this.valid = null
                this.available = null
            }
            Spruce.store("register").check()

        }
    },
    /**
     * password validation
     */
    password: {
        valid: null,
        password: null,
        confirm: null,
        set _password(value) {
            this.password = value
            this.check()
        },
        set _confirm(value) {
            this.confirm = value
            this.check()
        },
        check() {
            if (this.password && this.confirm) {
                this.valid = this.password == this.confirm
            } else {
                this.valid = null
            }
            Spruce.store("register").check()

        }
    },
    valid: null, // Whether the form is valid
    /**
     * Check if every required values are valid
     */
    check() {
        if (this.password.valid && this.username.available && this.email.available) {
            this.valid = true
        } else {
            this.valid = null
        }
    }
})