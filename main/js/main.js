const limit = 330;
const reportDesc = document.querySelectorAll('.report-desc');

reportDesc.forEach(desc => {

    const fullText = desc.innerText;

    function shortDescription() {

        const shortText = fullText.substring(0, limit);

        desc.innerHTML = `${shortText}... <span class="see-more">See more</span>`;

        const seeMore = desc.querySelector('.see-more');

        seeMore.onclick = fullDescription;
    }

    function fullDescription() {

        desc.innerHTML = `${fullText} <span class="see-less">See less</span>`;

        const seeLess = desc.querySelector('.see-less');

        seeLess.onclick = shortDescription;
    }

    if(fullText.length > limit){
        shortDescription();
    }

});