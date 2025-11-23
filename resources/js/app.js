import './bootstrap';
import persist from '@alpinejs/persist';

// Solo registramos el plugin y conectamos la persistencia
document.addEventListener('alpine:init', () => {
    Alpine.plugin(persist);

    // Conectamos el array 'items' del store que creamos en el HTML con LocalStorage
    // Esto sobreescribe la propiedad 'items' vacía con la versión persistente
    Alpine.store('cart').items = Alpine.$persist([]).as('budget_cart');
});

// Listener global
window.addEventListener('budget-sent', () => {
    if (window.Alpine) {
        Alpine.store('cart').clear();
    }
});