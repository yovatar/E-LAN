Spruce.store('register', {
    valid: null,
    passwordValid: null,
    password: null,
    confirm: null,
    set _password(value) {
        this.password = value
        this.checkValidPassword()
    },
    set _confirm(value) {
        this.confirm = value
        this.checkValidPassword()
    },
    checkValidPassword() {
        if (this.password && this.confirm) {
            this.passwordValid = this.password == this.confirm
        } else {
            this.passwordValid = null
        }
    }
})