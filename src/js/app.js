document.addEventListener('DOMContentLoaded', function(){

    eventListeners()
    darkMode()

})

function eventListeners () {

    const mobilMenu = document.querySelector('.mobile-menu')

    mobilMenu.addEventListener('click', navegacionResponsive )

}

function navegacionResponsive () {

    const navegacion = document.querySelector('.navegacion')
    
        navegacion.classList.toggle('mostrar')
    
}

function darkMode () {  
    
    // Preferencias del sistema (dark = true)
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')

    systemDarkmode()  

    // Si se cambia la preferencia del sistema 
    prefiereDarkMode.addEventListener('change', systemDarkmode())
  
    // Función que cambia el modo según la preferencia del sistema
    function systemDarkmode () {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode')
        } else {
            document.body.classList.remove('dark-mode')
        }        
    }    
    
    //Boton DarkMode
    const botonDarkMode = document.querySelector('.dark-mode-boton')
    botonDarkMode.addEventListener('click', function(){

        document.body.classList.toggle('dark-mode')
 
        //Para que el modo elegido se quede guardado en local-storage
        if (document.body.classList.contains('dark-mode')) {
            sessionStorage.setItem('modo-oscuro','true')
        } else {
            sessionStorage.setItem('modo-oscuro','false')
        }
    });        

    // Cada vez que hay reload (F5) pone el modo por defecto en el sistema operativo
    if (String(window.performance.getEntriesByType("navigation")[0].type) === "reload") {
        sessionStorage.setItem('modo-oscuro', window.matchMedia('(prefers-color-scheme: dark)').matches)
    }

    //Obtenemos el modo del color actual    
    if (sessionStorage.getItem('modo-oscuro') === 'true') {
        document.body.classList.add('dark-mode')
    } else if (sessionStorage.getItem('modo-oscuro') === 'false') {
        document.body.classList.remove('dark-mode')
    }   

}

