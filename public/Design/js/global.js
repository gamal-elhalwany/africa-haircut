

let showDeleteBranchBoxBtn = document.getElementById('show_delete_branch_box');
let deleteBranchContainer = document.getElementById('delete_branch_container');
let closeDeleteBranchContainer = document.getElementById('close_delete_branch_container');


showDeleteBranchBoxBtn.onclick = function (){
    deleteBranchContainer.style.display='block';
}
closeDeleteBranchContainer.onclick = function (){
    deleteBranchContainer.style.display='none';
}


//Product Routes
 function ProductStateHideInputs(){
       if (event.target.value === 'service'){

           const productState = document.getElementById('product_state').style;
           productState.display ='none'

       } else {
           const productState = document.getElementById('product_state').style;
           productState.display ='block'
       }

 }


// User State
//user_state
function UserStateHideInputs(){
    if (event.target.value ==='commotion'){
        const Commotion = document.getElementById('commotion').style;
        const userState = document.getElementById('user_state').style;
        Commotion.display ='block';
        userState.display ='none';
    } else if (event.target.value ==='basic'){
        const Commotion = document.getElementById('commotion').style;
        const userState = document.getElementById('user_state').style;
        Commotion.display ='none';
        userState.display ='block';
    } else{
        const Commotion = document.getElementById('commotion').style;
        const userState = document.getElementById('user_state').style;
        Commotion.display ='block';
        userState.display ='block';
    }
}

