let btn     = document.querySelector('#btn');
let out     = document.querySelector('#out');
let weight  = document.querySelector('#weight');
let load    = document.querySelector('#load');
let del     = document.querySelector('#del');
let frag    = document.querySelector('#frag');

let kg = 0.45;
let kg1 = 0.45;
let kg2 = 0.2;





btn.onclick = function(){

    if (load.checked  ) {
        doSomething() 
    } if (del.checked  ) {
            doSomething1() 
        } if ( frag.checked ) {
                doSomething2() 
            }else{
                alert('Выберете регион');
                }   

function doSomething() {

if (weight.value != '' ) {
   let sum = (weight.value * kg  ) ;
      out.innerHTML = sum;
  }else{
alert('Введите вес техники');
    }
}


function doSomething1() {

    if (weight.value != '' ) {
       let sum = (weight.value * kg1  ) ;
          out.innerHTML = sum;
      }else{
    alert('Введите вес техники');
        }
    }


function doSomething2() {

        if (weight.value != '' ) {
           let sum = (weight.value * kg2  ) ;
              out.innerHTML = sum;
          }else{
        alert('Введите вес техники');
            }
        }
}


        
   



       




