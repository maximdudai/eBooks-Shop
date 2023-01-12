'use strict'

let VISIBLE_TYPE_CATEGORY = 0;

const btnMenuCategory = document.querySelector(".menuCategory");
const btnMenuSubCategory = document.querySelector(".menuSubCategory");

const visibleCategoryMenu = document.querySelector(".addCategory");
const visibleSubCategoryMenu = document.querySelector(".addSubCategory");

btnMenuCategory.addEventListener('click', () => {
    changeVisibleCategory(0);
});
btnMenuSubCategory.addEventListener('click', () => {
    changeVisibleCategory(1);
});


function changeVisibleCategory(type) {

    if(type == VISIBLE_TYPE_CATEGORY)
        return;

    switch(type) {
        case 1: {
            btnMenuCategory.classList.remove('active');
            visibleCategoryMenu.classList.remove('active');
            visibleCategoryMenu.classList.add('d-none');
            
            
            btnMenuSubCategory.classList.add('active');
            visibleSubCategoryMenu.classList.add('active');
            if(visibleSubCategoryMenu.classList.contains('d-none'))
                visibleSubCategoryMenu.classList.remove('d-none');

            break;
        }

        default: {

            btnMenuSubCategory.classList.remove('active');
            visibleSubCategoryMenu.classList.remove('active');
            visibleSubCategoryMenu.classList.add('d-none');
            
            btnMenuCategory.classList.add('active');
            visibleCategoryMenu.classList.add('active');
            if(visibleCategoryMenu.classList.contains('d-none'))
                visibleCategoryMenu.classList.remove('d-none');


            break;
        }
    }

    VISIBLE_TYPE_CATEGORY = type;

    return true;
};  