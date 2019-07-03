let tabs = document.querySelectorAll('.tabs a')

for (let i = 0; i < tabs.length; i++){
    tabs[i].addEventListener('click', function (e) {
        e.preventDefault()
        showTag(this)
    })
}

const showTag = function (a){
    let li = a.parentNode
    let div = a.parentNode.parentNode.parentNode

    if (li.classList.contains('active')){
        return false
    }
    div.querySelector('.tabs .active').classList.remove('active')
    li.classList.add('active')

    div.querySelector('.tab-content.active').classList.remove('active')
    div.querySelector(a.getAttribute('href')).classList.add('active')
}

const hashchange = function(){
    let hash = window.location.hash
    let a = document.querySelector('a[href="'+ hash +'"]')
    if (a !== null && !a.parentNode.classList.contains('active')) {
        showTag(a)
    }
}

window.addEventListener('hashchange', hashchange)
hashchange()


let arrReason = new Object();
arrReason.secondList = {
    "voirie": ['Mobiliers', 'Revêtements', 'Signalisations au sol'],
    "signalisation": ['Feux tricolores', 'Panneaux directionnels', 'Panneaux sectorisations'],
    "espacesVerts": ['Parcs', 'Squares', 'Aires de jeu', 'Espaces ornementaux'],
    "proprete": ['Poubelles', 'Ramassages', 'Dégradations', 'Propreté de la voirie']
};
arrReason.getSelect = function(slist, option) {
    if(arrReason[slist]) {
        if(slist == 'secondList') {
            let addata = '<option>Raison</option>'
            for(let i=0; i<arrReason[slist][option].length; i++) {
                addata += '<option value="'+arrReason[slist][option][i]+'">'+arrReason[slist][option][i]+'</option>'
            }
            document.getElementById('secondList').innerHTML = '<select name="secondList" onchange="arrReason.getSelect(this.value);">'+addata+'</select><br>'
        }
    }
    else if(slist == 'secondList') {
        document.getElementById('secondList').innerHTML = ''
    }
}
/*forms*/

/*let boutton = document.getElementById('send')
// let input = document.querySelectorAll('input')

let firstName,
    lastName,
    tel,
    email,
    msg

boutton.addEventListener('click', function(){
    let person = recuper()

    fetch('http://boulogne:8888/form_contact_ajax.php', {
        method: 'POST',
        headers : new Headers(),
        body:JSON.stringify(person)
    })
        .then((res) => res.text())
        .then((data) =>  console.log(data))

})

const recuper = function(){
    firstName = document.getElementById('first_name').value
    lastName = document.getElementById('last_name').value
    tel = document.getElementById('phone_number').value
    email = document.getElementById('email').value
    msg = document.getElementById('description').value
    let donnes = {
        firstName: firstName,
        lastName: lastName,
        tel: tel,
        email: email,
        msg: msg
    }
    console.log(donnes)
    return donnes
}*/