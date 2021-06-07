Spruce.store('passwordCheck', {
    valid: null,
    password: null,
    confirm: null,
    set _password(value) {
        this.password = value
        this.checkValid()
    },
    set _confirm(value) {
        this.confirm = value
        this.checkValid()
    },
    checkValid() {
        if (this.password && this.confirm) {
            this.valid = this.password == this.confirm
        } else {
            this.valid = null
        }
    }
})