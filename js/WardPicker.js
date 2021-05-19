


const WardPicker = {
    ui : null,
    hide: ()=>{
        WardPicker.ui && $(WardPicker.ui).addClass("hidden");
    },
    render : ()=>{
        const container = document.createElement("div");
        container.className = "list";
 
       
        container.style.width= "100%";
        container.style.height = "100%";

        const items = [{name : "test", code : "doe"}];
        for (let pos = 0; pos < items.length; pos++) {
            const item = items[pos];
            container.appendChild(WardItem(item, ()=>{
                WardPicker.onPick && WardPicker.onPick(item, pos)
            }));
        }
    
        return container;
    },
    show: ()=>{
        if(!WardPicker.ui){
            WardPicker.ui = WardPicker.render();
        }

        $(WardPicker.ui).removeClass("hidden");
        return WardPicker.ui;
    }
}

const WardItem = (ward, onclick)=>{
    const avatarText = ward.name[0];

    const container = document.createElement("div");
    container.className = "list-item";
    container.style.cursor = "pointer";
    container.onclick = onclick;
 

    const ui = `<div class="avatar"><h6 style="height: fit-content;align-self: center;">${ avatarText.toUpperCase() }</h6></div>
    <div class="col" style="padding: 8px">
        <h6>${ ward.name }</h6>
        <h6 class="subtext-light">CODE: ${ward.code}</h6>
    </div>`
    container.innerHTML += ui;

return container;

}