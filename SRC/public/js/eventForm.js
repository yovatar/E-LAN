document.addEventListener("alpine:initializing", () => {

    Alpine.store('form', {
        name: '',
        description: '',
        _start: null,
        _end: null,
        _diff: null,
        set start(value) {
            this._start = new Date(value)
            this.updateDiff()
        },
        get start() {
            return this._start ? `${this._start.getFullYear()}-${this._start.getMonth().toString().padStart(2, '0')}-${this._start.getDay().toString().padStart(2, '0')} ${this._start.getHours().toString().padStart(2, '0')}:${this._start.getMinutes().toString().padStart(2, '0')}` : null
        },
        set end(value) {
            this._end = new Date(value)
            this.updateDiff()
        },
        get end() {
            return this._end
        },
        set diff(value) {
            this._diff = value
        },
        get diff() {
            let days = Math.floor(this._diff / 86400000)
            let hours = Math.floor((this._diff - days * 86400000) / 3600000)
            let minutes = Math.floor((this._diff - days * 86400000 - hours * 3600000) / 60000)
            return this._diff ? `${days > 0 ? days + 'j ' : ''}${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}` : null
        },
        updateDiff() {
            if (this.start === null || this.end === null) {
                this._diff = null
            } else {
                this._diff = this._end.getTime() - this._start.getTime()
            }
        }
    })

})