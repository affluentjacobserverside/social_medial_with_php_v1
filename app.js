// SIDEBAR
const menuItems = document.querySelectorAll('.menu-item');
// MESSAGE
const messagesNotification = document.querySelector('#messages-notification');
const messages = document.querySelector('.messages');

const message = document.querySelectorAll('.message');
const messageSearch = document.querySelector('#message-search');

//theme
const theme = document.querySelector('#theme');

const modalPostBtn = document.querySelector('#modal-create-post');

// settings style
const settings = document.querySelector('#settings');
const settingsModal = document.querySelector('.settingsModal');

const modalCreatePost = document.querySelector('.modal-create-post');
const themeModal = document.querySelector('.customize-theme');

// fontsizes
const fontsizes = document.querySelectorAll('.choose-size span');

// getting the root element
var root = document.querySelector(':root');

// colors
const colorPalette = document.querySelectorAll('.choose-color span');

//backgrounds
const Bg1 = document.querySelector('.bg-1');
const Bg2 = document.querySelector('.bg-2');
const Bg3 = document.querySelector('.bg-3');


// remove active class from all menu items
const changeActiveItem = () =>{
    menuItems.forEach(item =>{
        item.classList.remove('active');
    })
}

menuItems.forEach(item =>{
    item.addEventListener('click', ()=>{
    changeActiveItem(); 
     item.classList.add('active');
     if(item.id != 'notifications'){
        document.querySelector('.notifications-popup').style.display = 'none';
       
     }else{
        document.querySelector('.notifications-popup').style.display = 'block';
        document.querySelector('#notifications .notification-count').style.display = 'none';
     }
    });
});

// ===========messages==========

// search chat function
const searchMessage = () =>{
const val = messageSearch.value.toLowerCase();
console.log(val);
message.forEach(chat=>{
   let name = chat.querySelector('h5').textContent.toLowerCase();
    if(name.indexOf(val) != -1){
        chat.style.display = 'flex';
    }else{
     chat.style.display = 'none';
    }
})
}

// search chat
messageSearch.addEventListener('keyup', searchMessage);



// hightlight messages card when message menu is clicked
messagesNotification.addEventListener('click', ()=>{
    messages.style.boxShadow = '0 0 1rem var(--color-primary)';
    messagesNotification.querySelector('.notification-count').style.display = 'none';
    setTimeout(()=>{
        messages.style.boxShadow = 'none';
    }, 2000);
})





// open theme modal function 
const openCreateModal = ()=>{
    modalCreatePost.style.display = 'grid';
    
    }
    // close theme modal function
    const closeCreateModal = (e)=>{
       if(e.target.classList.contains('modal-create-post')){
        modalCreatePost.style.display = 'none';
       }
    }
    // close modal
    modalCreatePost.addEventListener('click', closeCreateModal);
    
    modalPostBtn.addEventListener('click', openCreateModal);


    // settings
    const openSettingsModal = () =>{
        settingsModal.style.display = 'grid';
    }
    // close setting modal
    const closeSettingsModal = (e) =>{
        if(e.target.classList.contains('settingsModal')){
            settingsModal.style.display = 'none';
        }
    }
    // close settings
    settingsModal.addEventListener('click', closeSettingsModal);
    settings.addEventListener('click', openSettingsModal);


// THEME/DISPLAY CUSTOMIZATION

// open theme modal function 
const openThemeModal = ()=>{
themeModal.style.display = 'grid';

}
// close theme modal function
const closeThemeModal = (e)=>{
   if(e.target.classList.contains('customize-theme')){
    themeModal.style.display = 'none';
   }
}
// close modal
themeModal.addEventListener('click', closeThemeModal);

theme.addEventListener('click', openThemeModal);


//===============FONTS============================
//remove active class from spans selector
const removeSizeSelector = ()=>{
    fontsizes.forEach(size=>{
     size.classList.remove('active');
    })
}
// loop through fontsizes
fontsizes.forEach(size =>{

    size.addEventListener('click', ()=>{
        // call the remove size selector function
        removeSizeSelector();
        let fontsize;
        size.classList.toggle('active');
        if(size.classList.contains('font-size-1')){
            fontsize = '10px';
            root.style.setProperty('--sticky-top-left', '5.4rem');
            root.style.setProperty('--sticky-top-right', '5.4rem');
        }else if(size.classList.contains('font-size-2')){
            fontsize = '13px';
            root.style.setProperty('--sticky-top-left', '5.4rem');
            root.style.setProperty('--sticky-top-right', '-7rem');
        }else if(size.classList.contains('font-size-3')){
            fontsize = '16px';
            root.style.setProperty('--sticky-top-left', '-2rem');
            root.style.setProperty('--sticky-top-right', '-17rem');
        }else if(size.classList.contains('font-size-4')){
            fontsize = '19px';
            root.style.setProperty('--sticky-top-left', '-5rem');
            root.style.setProperty('--sticky-top-right', '-25rem');
        }else if(size.classList.contains('font-size-5')){
            fontsize = '22px';
            root.style.setProperty('--sticky-top-left', '-12rem');
            root.style.setProperty('--sticky-top-right', '-35rem');
        }
           // change font size of the html element
    document.querySelector('html').style.fontSize = fontsize;
    });
 
})
// remove active class function for colors
  const changeActiveColorClass = () =>{
    colorPalette.forEach(colorpicker=>{
        colorpicker.classList.remove('active');
    });
  }


// change primary colors

colorPalette.forEach(color=>{

    color.addEventListener('click', ()=>{
     let primaryHue;
     // remove active class
     changeActiveColorClass();
     if(color.classList.contains('color-1')){
        primaryHue = 252;
       
     }else if(color.classList.contains('color-2')){
        primaryHue = 52;
     }else if(color.classList.contains('color-3')){
        primaryHue = 352;
     }else if(color.classList.contains('color-4')){
        primaryHue = 152;
     }else if(color.classList.contains('color-5')){
        primaryHue = 202;
     }
     
     // add active class
     color.classList.add('active');
     
     // get root sytle
      root.style.setProperty('--primary-color-hue', primaryHue);
    });
    
});


// Theme background values
let lightColorLightness;
let whiteColorLightness;
let darkColorLightness;
// change background color
const changeBg = ()=>{
    root.style.setProperty('--light-color-lightness', lightColorLightness);
    root.style.setProperty('--white-color-lightness', whiteColorLightness);
    root.style.setProperty('--dark-color-lightness', darkColorLightness);

}
Bg1.addEventListener('click', ()=>{

    // add active class
    Bg1.classList.add('active');
    // remove active class from the others
    Bg2.classList.remove('active');
    Bg3.classList.remove('active');
    // remove customized changes from local storage
    window.location.reload(); 
}); 
Bg2.addEventListener('click', ()=>{
    darkColorLightness = '95%';
    whiteColorLightness = '20%';
    lightColorLightness = '15%';

    // add active class
    Bg2.classList.add('active');
    // remove active class from the others
    Bg1.classList.remove('active');
    Bg3.classList.remove('active');
    changeBg();
});  
Bg3.addEventListener('click', ()=>{
    darkColorLightness = '95%';
    whiteColorLightness = '10%';
    lightColorLightness = '0%';

    // add active class
    Bg3.classList.add('active');
    // remove active class from the others
    Bg1.classList.remove('active');
    Bg2.classList.remove('active');
    changeBg();
}); 

