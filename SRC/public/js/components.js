function imageViewer() {
    return {
        imageUrl: null,

        fileChosen(event) {
            this.fileToDataUrl(event, src => this.imageUrl = src)
        },

        fileToDataUrl(event, callback) {
            if (!event.target.files.length) return

            let file = event.target.files[0],
                reader = new FileReader()

            reader.readAsDataURL(file)
            reader.onload = e => callback(e.target.result)
        },
    }
}

// global stores and data
document.addEventListener("alpine:initializing", () => {
    Alpine.data('dropdown', () => ({
        open: false,

        toggle() {
            this.open = !this.open
        }

    }))

    Alpine.store('toasts', {
        toasts: [],
        error(message) {
            this.toasts.push({ message: message, class: 'bg-red-500 text-white' })
        },
        success(message) {
            this.toasts.push({ message: message, class: 'bg-green-500 text-white' })
        },
        warning(message) {
            this.toasts.push({ message: message, class: 'bg-yellow-500 text-white' })
        },
        info(message) {
            this.toasts.push({ message: message, class: 'bg-blue-500 text-white' })
        }
    })
})
