$( document ).ready(function() {

    const pickers = initPickers();
    const wardPicker = pickers["picker-reg-candi"];
    wardPicker.objToString = (obj)=>{
        return obj.name;
    }


    wardPicker.onPick = ()=>{
        console.log("onpick");
        const content = $("#container-picker-candi").children().first();
        content.addClass("hidden");

        console.log(content.html())

        WardPicker.onPick = (ward, pos)=>{
            wardPicker.setSelection(ward)
            content.removeClass("hidden");
            WardPicker.hide()
        }
        $("#container-picker-candi").append(WardPicker.show());
    }



    document.getElementById("btn-reg-party").onclick  =()=>{
        const elementName = $("#inp-name");
        const elementLogo = $("#inp-logo");
 
 
        elementName.removeClass("input-error");
        elementLogo.removeClass("input-error");
 
        $("#s-error").addClass("hidden");

        const name = elementName.val();
        const files = elementLogo.prop("files");
        const logo = files[0];


        const errors = [];
        if(!name || name == ""){
            errors.push("Name");
            elementName.addClass("input-error");
        }
        if(!logo){
            errors.push("Logo");
            elementLogo.addClass("input-error");
        } 
        if(errors.length == 0){
            const body = { name, logo};
            console.log("reg", body);

        }else{
            $("#s-error").removeClass("hidden").html("Invalid: " + errors.join(", "));
        }
         return false;
    }

    document.getElementById("btn-reg-candi").onclick  =()=>{
        const elementName = $("#inp-name-candi");
  
 
        elementName.removeClass("input-error");
        wardPicker.setError(false);
        $("#s-error-candi").addClass("hidden");      
        
        const name = elementName.val();
        const ward = wardPicker.selection;




        const errors = [];
        if(!name || name == ""){
            errors.push("Name");
            elementName.addClass("input-error");
        }
        if(!ward){
            errors.push("Ward");
            wardPicker.setError(true);
        }

        if(errors.length == 0){
            const body = { name, ward};
            console.log("reg", body);

        }else{
            $("#s-error-candi").removeClass("hidden").html("Invalid: " + errors.join(", "));
        }
         return false;
    }
});