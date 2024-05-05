function changePreviewImage(img){
    if (img.classList.contains("active")){
        return;
    }
    const parent = img.parentNode.parentNode;

    for(const child of parent.children){
        childImg = child.children[0];
        if(childImg.classList.contains("active")){
            childImg.classList.remove("active");
        }
    }
    img.classList.add("active");
    document.getElementById("largeProductIMG").src = img.src;
}

function changePreviewImageHorizontal(img){
    if (img.classList.contains("active")){
        return;
    }
    const parent = img.parentNode.parentNode.parentNode;


    for(const child of parent.children){
        childImg = child.children[0].children[0];
        if(childImg.classList.contains("active")){
            childImg.classList.remove("active");
        }
    }
    img.classList.add("active");
    document.getElementById("largeProductIMG").src = img.src;
}


// function updateFilterRangeOutput(input_value, output_id){
//     document.getElementById(output_id).value = input_value; 
// }

function changeSliderValue(input_value, output_id){
    document.getElementById(output_id).value = input_value;

    
}

const filter_min = document.getElementById("filter-range-price-min")
const filter_min_text = document.getElementById("filter-min-text")
const filter_max = document.getElementById("filter-range-price-max")
const filter_max_text = document.getElementById("filter-max-text")

filter_min.addEventListener('input', function() {
    filter_min_text.value = filter_min.value;
});
filter_max.addEventListener('input', function() {
    filter_max_text.value = filter_max.value;
});

function switchCollapseElement(element_id){
    element = document.getElementById(element_id);
    if (element.innerHTML.includes('+')){
        element.innerHTML = '-';
    }
    else if(element.innerHTML.includes('-')){
        element.innerHTML = '+';
    }
}