const inputs = document.querySelectorAll("input");
const button = document.getElementById("submit");
inputs.forEach((input, index) =>{
    input.addEventListener("keydown", (e) =>{
        if(e.key === "Enter"){
            let nextinput = inputs[index+1];
            console.log(index);
            e.preventDefault();
            if(nextinput){
                e.preventDefault();
                nextinput.focus();
            }else{
                button.focus();
            }
        }
    })
}); //QOL script that checks if there is a next input, if so, then it will allow the user to switch to it automatically without having to click. If there are no more inputs, it sends the user to the next page.

