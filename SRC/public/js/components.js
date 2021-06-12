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

    Alpine.data('toastArea', {
        test() {
            return "this is a test"
        }
    })

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

document.addEventListener("alpine:initialized", () => {
    fetchUrlToasts()
})

function fetchUrlToasts() {

    // Check url query params for alert messages
    const urlParams = new URLSearchParams(window.location.search)
    if (urlParams.has('error')) Alpine.store('toasts').error(urlParams.get('error'))
    if (urlParams.has('success')) Alpine.store('toasts').success(urlParams.get('success'))
    if (urlParams.has('warning')) Alpine.store('toasts').warning(urlParams.get('warning'))
    if (urlParams.has('info')) Alpine.store('toasts').info(urlParams.get('info'))

}