
class ReactionSystem {
    thumbsUpButton = null;
    thumbsDownButton = null;
    laughingButton = null;
    heartButton = null;
    sadButton = null;
    
    currentIndex = 0;



    getCurrentReaction() {
        switch (this.currentIndex) {
            case 0:
                return this.thumbsUpButton;
            case 1:
                return this.thumbsDownButton;
            case 2:
                return this.laughingButton;
            case 3:
                return this.heartButton;
            case 4:
                return this.sadButton;
            default:
                return null;
        }
        
    }

    setReaction(index) {

        let data = {
            func: this.currentIndex == index ? 'removeReaction' : 'setReaction',
            topicId: identifier,
            reaction: index,
        };

        $.ajax({
            url: '/src/util/topic-reaction.php',
            type: 'POST',
            async: true,
            data: data,
        });



        const current = this.getCurrentReaction();
        if (current != null) {
            current.classList.remove('topic-reaction-highlight');
            let counter = current.children[1];
            counter.innerHTML = parseInt(counter.innerHTML) - 1;

            if (this.currentIndex == index) {
                this.currentIndex = null;
                return;
            }

        }

        this.setHighlight(index);
        let counter = this.getCurrentReaction().children[1];
        counter.innerHTML = parseInt(counter.innerHTML) + 1;
    }

    setHighlight(index) {
        if (this.getCurrentReaction() != null) {
            this.getCurrentReaction().classList.remove('topic-reaction-highlight');
        }

        this.currentIndex = index;
        
        if (this.getCurrentReaction() != null) {
            this.getCurrentReaction().classList.add('topic-reaction-highlight');
        }
    }



    constructor(thumbsUpButton, thumbsDownButton, laughingButton, heartButton, sadButton) {
        this.thumbsUpButton = thumbsUpButton;
        this.thumbsDownButton = thumbsDownButton;
        this.laughingButton = laughingButton;
        this.heartButton = heartButton;
        this.sadButton = sadButton;


        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const identifier = urlParams.get('id')

        let data = {
            topicId: identifier,
        };

        let result = 0;

        $.ajax({
            url: '/src/util/topic-reaction.php',
            type: 'GET',
            async: false,
            data: data,
            success: function(response) {
                result = response;
            }
        });
        this.setHighlight(parseInt(result));





        this.thumbsUpButton.onclick = () => {
            this.setReaction(0);
        };
        this.thumbsDownButton.onclick = () => {
            this.setReaction(1);
        };
        this.laughingButton.onclick = () => {
            this.setReaction(2);
        };
        this.heartButton.onclick = () => {
            this.setReaction(3);
        };
        this.sadButton.onclick = () => {
            this.setReaction(4);
        };

    }
}

new ReactionSystem(document.getElementById('thumbs-up-reaction'), document.getElementById('thumbs-down-reaction'), document.getElementById('laughing-reaction'), document.getElementById('heart-reaction'), document.getElementById('sad-reaction'));