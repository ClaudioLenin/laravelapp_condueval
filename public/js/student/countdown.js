const getRemainTime = deadline => {
    let now = new Date(),
            remainTime = (new Date(deadline) - now + 1000) / 1000,
            remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
            remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2),
            remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
            remainDays = Math.floor(remainTime / (3600 * 24));

    return{
        remainTime,
        remainSeconds,
        remainMinutes,
        remainHours,
        remainDays
    }
};

console.log(getRemainTime('Aug 28 2019 09:50:23 GMT-0500'));


const countdown = (deadline, elem, finalMessage) => {
    const el = document.getElementById(elem);
    const timerUpdate = setInterval(()=>{
        let t = getRemainTime(deadline);
        el.innerHTML = `${t.remainHours}h:${t.remainMinutes}m:${t.remainSeconds}s`;

        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML = finalMessage;
            document.getElementById("guardar_examen_estudiante").click();
        }
    },1000)
};
var reloj = document.getElementById("reloj").textContent;
countdown(reloj,'clock','Tiempo terminado...');
