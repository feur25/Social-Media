
class LazyLoading {
    container;
    functionName
    contentOffset;
    contentIncrement;
    id;


    shouldExecute = true;


    constructor(triggerElement, functionName, contentIncrement, id = null) {
        this.contentOffset = 0;
        this.container = triggerElement;
        this.functionName = functionName;
        this.contentIncrement = contentIncrement;
        this.id = id;

        if (this.container == null) {
            this.shouldExecute = false;
            return;
        }

        // Load Content when the user scrolls to the trigger
        window.addEventListener('scroll', () => {
            // check if the bottom of the container is in view
            if (this.shouldExecute && this.container.getBoundingClientRect().bottom <= window.innerHeight + 20) {
                this.loadContent();
            }
        });

        this.loadContent();

    }


    loadContent() {

        if ( !this.shouldExecute ) {
            return;
        }

        let data = {
            offset: this.contentOffset,
            length: this.contentIncrement,
            func: this.functionName,
            id: this.id
        };

        let result;

        $.ajax({
            url: '/src/util/lazy-load.php',
            type: 'GET',
            async: false,
            data: data,
            success: function(response) {
                result = response;
            }
        });

        if (result === '') {
            this.shouldExecute = false;
            console.log('No more content to load');
            return;
        }

        this.contentOffset += this.contentIncrement;

        // Create the new elements
        this.container.innerHTML = this.container.innerHTML + result;

    }
}

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);



new LazyLoading( document.getElementById('topics-list'), 'topic', 10 );
const identifier = urlParams.get('id')
new LazyLoading( document.getElementById('user-topics-list'), 'user-topic', 10, identifier);