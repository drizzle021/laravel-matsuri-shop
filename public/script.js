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

const shipping_name = document.getElementById("shipping_select").selectedOptions[0].innerHTML.split(" - ")[0];
const shipping_value = document.getElementById("shipping_select").selectedOptions[0].innerHTML.split(" - ")[1];
document.getElementById("selected_shipping").children[0].innerHTML = shipping_name;
document.getElementById("selected_shipping").children[1].innerHTML = shipping_value;

const payment_name = document.getElementById("payment_select").selectedOptions[0].innerHTML.split(" - ")[0];
const payment_value = document.getElementById("payment_select").selectedOptions[0].innerHTML.split(" - ")[1];
document.getElementById("selected_payment").children[0].innerHTML = payment_name;
document.getElementById("selected_payment").children[1].innerHTML = payment_value;

let total = parseFloat(document.getElementById("checkout_sum").children[1].innerHTML);
total += parseFloat(payment_value) + parseFloat(shipping_value);
document.getElementById("checkout_sum").children[1].innerHTML = Math.round(total *100)/100+"€";



    if(document.getElementById("matsuri_points").checked){
        total = parseFloat(document.getElementById("checkout_sum").children[1].innerHTML);

        total -= total*0.10;

        document.getElementById("checkout_sum").children[1].innerHTML = Math.round(total *100)/100+"€";
    }

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


function changeShippingField(){
    const name = document.getElementById("shipping_select").selectedOptions[0].innerHTML.split(" - ")[0];
    const value = document.getElementById("shipping_select").selectedOptions[0].innerHTML.split(" - ")[1];
    document.getElementById("selected_shipping").children[0].innerHTML = name;
    let prev_value = parseFloat(document.getElementById("selected_shipping").children[1].innerHTML);
    document.getElementById("selected_shipping").children[1].innerHTML = value;

    let total = parseFloat(document.getElementById("checkout_sum").children[1].innerHTML);
    total -= prev_value;
    total += parseFloat(value);
    document.getElementById("checkout_sum").children[1].innerHTML = Math.round(total *100)/100+"€";
}

function changePaymentField(){
    const name = document.getElementById("payment_select").selectedOptions[0].innerHTML.split(" - ")[0];
    const value = document.getElementById("payment_select").selectedOptions[0].innerHTML.split(" - ")[1];
    document.getElementById("selected_payment").children[0].innerHTML = name;
    let prev_value = parseFloat(document.getElementById("selected_payment").children[1].innerHTML);
    document.getElementById("selected_payment").children[1].innerHTML = value;

    let total = parseFloat(document.getElementById("checkout_sum").children[1].innerHTML);
    total -= prev_value;
    total += parseFloat(value);
    document.getElementById("checkout_sum").children[1].innerHTML = Math.round(total *100)/100+"€";
}

function changeDiscount(){
    element = document.getElementById("matsuri_points");
    if(element.checked){
        total = parseFloat(document.getElementById("checkout_sum").children[1].innerHTML);

        total -= total*0.10;

        document.getElementById("checkout_sum").children[1].innerHTML = Math.round(total *100)/100+"€";
    }
    else{

        total = parseFloat(document.getElementById("checkout_sum").children[1].innerHTML);

        total /= 0.9;

        document.getElementById("checkout_sum").children[1].innerHTML = Math.round(total *100)/100+"€";
    }

    console.log(element);
}