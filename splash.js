const key = document.querySelector('.headerist');

function roller(){
    if(this.scrollY > 20){
        console.log(this.scrollY);
        key.style.backgroundColor = '#4F4A4A'
    }
    else{
        key.style.backgroundColor = 'transparent';
    }

    
}

window.addEventListener('scroll', roller)
