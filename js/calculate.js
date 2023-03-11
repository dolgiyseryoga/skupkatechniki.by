let btn     = document.querySelector('#btn');
let out     = document.querySelector('#out');
let weight  = document.querySelector('#weight');
let load    = document.querySelector('#load');
let del     = document.querySelector('#del');
let frag    = document.querySelector('#frag');

let btn_reset = document.querySelector('#btn_reset');
let btn_Calc = document.querySelector('#btn_Calc');

let Vitebsk_price = 0.45;
let Polotzk_price = 0.45;
let Region_price = 0.2;

btn.onclick = function(){

    if (load.checked  ) {
        if (weight.value != '') {
            let sum = (weight.value * Vitebsk_price) ;
               out.innerHTML = sum.toFixed(2);
           } else{
         alert('Введите вес техники и регион');
             }            
    } if (del.checked  ) {
        if (weight.value != '' ) {
            let sum = (weight.value * Polotzk_price) ;
               out.innerHTML = sum.toFixed(2);
           }else{
         alert('Введите вес техники');
             } 
        } if ( frag.checked ) {
            if (weight.value != '' ) {
                let sum = (weight.value * Region_price) ;
                   out.innerHTML = sum.toFixed(2);
               }else{
             alert('Введите вес техники');
                 }
             } 
            }

btn_reset.onclick = function(){
    weight.value = '';
    load.checked = 0;
    del.checked = 0;
    frag.checked = 0;
    out.innerHTML = 0.0;
}
   
btn_Calc.onclick = function(){
   if( document.getElementById('Calc_form').style.display!='block') {
    document.getElementById('Calc_form').style.display='block';
   } else {
    document.getElementById('Calc_form').style.display='none';
   }
}