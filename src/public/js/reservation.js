'use strict';
{
    const selectDate = document.getElementById('date');
    const selectTime = document.getElementById('time');
    const selectNumber = document.getElementById('number');
    const selectedDate = document.getElementById('selectedDate');
    const selectedTime = document.getElementById('selectedTime');
    const selectedNumber = document.getElementById('selectedNumber');

    selectDate.addEventListener('change',function(){
        console.log('change date');
        selectedDate.innerText = selectDate.value
    });
    selectTime.addEventListener('change',function(){
        console.log('change time');
        const num = selectTime.selectedIndex;
        selectedTime.innerText = selectTime.options[num].innerText;
    });
    selectNumber.addEventListener('change',function(){
        console.log('change number');
        const num = selectNumber.selectedIndex;
        selectedNumber.innerText = selectNumber.options[num].innerText;
    });
}
