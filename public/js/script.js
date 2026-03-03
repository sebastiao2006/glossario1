document.addEventListener('DOMContentLoaded', function() {
    const showFormBtn = document.getElementById('showFormBtn');
    const addTaskForm = document.getElementById('addTaskForm');

    showFormBtn.addEventListener('click', function() {
        if(addTaskForm.style.display === 'none' || addTaskForm.style.display === '') {
            addTaskForm.style.display = 'block';
            showFormBtn.textContent = '✖ Fechar Formulário';
        } else {
            addTaskForm.style.display = 'none';
            showFormBtn.textContent = '+ Adicionar Tarefa';
        }
    });
});