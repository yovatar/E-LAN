document.addEventListener('alpine:initializing', () => {
    Alpine.store('register', {
        /**
         * username validation
         */
        username: {
            available: null,
            /**
             * Check if username is available
             */
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
                Alpine.store("register").check()
            }
        },
        /**
         * email validation
         */
        email: {
            available: null,
            valid: null,
            /**
             * Check if email is valid and available
             * @param {string} email
             */
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
                Alpine.store("register").check()

            }
        },
        /**
         * password validation
         */
        password: {
            valid: null,
            _password: null,
            _confirm: null,
            get password() {
                return this._password
            },
            set password(value) {
                this._password = value
                this.check()
            },
            get confirm() {
                return this._confirm
            },
            set confirm(value) {
                this._confirm = value
                this.check()
            },
            /**
             * Check if password matches
             */
            check() {
                if (this.password && this.confirm) {
                    this.valid = this.password == this.confirm
                } else {
                    this.valid = null
                }
                Alpine.store("register").check()

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
})