
let coll = document.getElementsByClassName("collapsiblePresentation");
let i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let content = this.nextElementSibling;
        if (content.style.maxHeight){
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

let map = document.querySelectorAll('.mapService')
//console.log(map)


map.forEach(function (buttonMap) {
    buttonMap.addEventListener('click', function () {
        //console.log(this.getAttribute('id'))
        let idService = this.getAttribute('id')
        //console.log(typeof idService)
        idService = parseInt(idService)
        /*console.log(typeof idService)*/

        let dataService = new FormData()
        dataService.append('id', idService) //id ; nom du parametre de new form

        fetch('map_Service.php', {
            method: 'POST',
            headers: new Headers(),
            body: dataService
        })

            .then((res) => res.json())

            .then((data) => {
                /*console.log(data)
                console.log(data.type)
                console.log(data.msg)*/
                console.log(data.service)
                console.log(data.service.close_at)



                /*console.log(data.service.title)*/
                document.querySelector('.titre').innerText = data.service.title
                /*document.querySelector('.modal').style.left = 0*/
                document.querySelector('.modal').classList.add('activemodal')
                document.querySelector('.pictureMap').setAttribute('src','./img/'+data.service.img)
                //document.querySelector('.secondGlobalFrame').setAttribute('src', data.service.coordonates)
                document.getElementById('globalFrame').innerHTML = '<iframe src="' + data.service.coordonates + '" class="secondGlobalFrame" frameborder="0" style="border:0" allowfullscreen></iframe>'
                document.querySelector('.informationAddress').innerText = data.service.address
                document.querySelector('.informationDays').innerText = data.service.opening_days
                document.querySelector('.informationOpening').innerText = data.service.open_at + ' ' + data.service.close_at
                document.querySelector('.informationPhone').innerText = data.service.phone_number



                /*document.querySelector('.contentMap').setAttribute('img', )*/
            })

            .catch((data) => {
                console.log(data)
                alert("une erreur est apparue")
            })

    })

})

let close = document.querySelector('#closer')
close.addEventListener('click', function () {
    document.querySelector('.modal').classList.remove('activemodal')
    //document.querySelector('.modal').classList.add('secondAnimodal')
    console.log(close)
})
