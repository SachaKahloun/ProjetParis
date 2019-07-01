var coll = document.getElementsByClassName("otherColl");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        console.log(this)
        var contentColl = this.nextElementSibling;
        if (contentColl.style.maxHeight){
            contentColl.style.maxHeight = null;
        } else {
            contentColl.style.maxHeight = contentColl.scrollHeight + "px";
        }
    });
}