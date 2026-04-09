class Auth {
    constructor() {
        // Seguimos usando localStorage para que la web no se resetee al refrescar
        this.users = JSON.parse(localStorage.getItem('users')) || [];
        this.currentUser = JSON.parse(localStorage.getItem('currentUser')) || null;
    }

    // --- ESTA ES LA FUNCIÓN QUE GUARDA EN LA BASE DE DATOS ---
    register(name, email, password) {
        // 1. Verificación local rápida
        if (this.users.find(u => u.email === email)) {
            return { success: false, error: 'El email ya está registrado' };
        }

        // 2. ENVÍO A MYSQL (PHP)
        // Esta es la parte que "habla" con tu base de datos
        fetch('api/register.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                name: name, 
                email: email, 
                password: password 
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                console.log("¡Confirmado! Usuario guardado en MySQL");
            } else {
                console.error("Error del servidor:", data.error);
            }
        })
        .catch(error => console.error("Error de conexión:", error));

        // 3. Guardado local (para que tus botones y redirecciones sigan funcionando)
        const newUser = { name, email, password };
        this.users.push(newUser);
        localStorage.setItem('users', JSON.stringify(this.users));
        
        this.currentUser = { email, name };
        localStorage.setItem('currentUser', JSON.stringify(this.currentUser));
        
        return { success: true };
    }

    login(email, password) {
        // Por ahora, el login sigue siendo local para que no te líes,
        // pero ya podrías usar fetch('api/login.php') aquí también.
        const user = this.users.find(u => u.email === email && u.password === password);
        if (user) {
            this.currentUser = { email: user.email, name: user.name };
            localStorage.setItem('currentUser', JSON.stringify(this.currentUser));
            return { success: true };
        }
        return { success: false, error: 'Credenciales inválidas' };
    }

    logout() {
        this.currentUser = null;
        localStorage.removeItem('currentUser');
    }

    isAuthenticated() {
        return this.currentUser !== null;
    }

    getCurrentUser() {
        return this.currentUser;
    }
}

const auth = new Auth();