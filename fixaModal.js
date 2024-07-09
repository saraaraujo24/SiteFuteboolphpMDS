


       const openModalButton = document.getElementById('open-modal');
       const closeModalButton = document.getElementById('close-modal');

       const modal = document.getElementById('modal');

       openModalButton.addEventListener('click', () => {
         modal.style.display = 'block';
       });
       
       closeModalButton.addEventListener('click', () => {
         modal.style.display = 'none';
       });
       
       // Optional: Close the modal by clicking outside the modal content
       window.addEventListener('submit', (event) => {

         modal.style.display = 'none';
       });
   

       