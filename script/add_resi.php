<script>
    function validateForm(){
        document.getElementById("resiError").textContent = '';

        let isValid = true;

        if(document.getElementById("resi").value.trim() === ''){
            document.getElementById("resiError").textContent = 'nomor resi tidak boleh kosong';
            isValid = false;
        }

        return isValid;
    }

    document.addEventListener("keydown", function(event){
            if(event.key === "Enter"){
                event.preventDefault();
                
                const submitModal = document.getElementById("confirmationModal");
                const isModalOpen = modalElement.classList.contains("show");

                if(!isModalOpen){
                    if(validateForm()){
                        const modal = new Bootstrap.Modal(submitModal);
                        modal.show();
                    }
                }else{
                    handleSave();
                }
            }else if(event.key === "Escape"){
                const submitModal = document.getElementById("confirmationModal");
                const modal = bootstrap.Modal.getInstance(submitModal);
                if(modal){
                    modal.hide();
                }
            }
        });

    function handleSave() {
        document.getElementById("submit-resi").submit();
    }
</script>