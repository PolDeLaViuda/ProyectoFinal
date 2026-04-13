class App {
    constructor() {
        this.user = JSON.parse(sessionStorage.getItem('user')) || null;
        window.addEventListener('load', () => this.init());
    }

    init() {
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.onsubmit = async (e) => {
                e.preventDefault(); // Evita la página blanca
                const formData = new FormData(loginForm);
                
                try {
                    const response = await fetch('php/login_usuario_be.php', {
                        method: 'POST',
                        body: formData
                    });
                    const res = await response.json();

                    if (res.success) {
                        this.user = res.user;
                        sessionStorage.setItem('user', JSON.stringify(this.user));
                        this.renderHome(); // Muestra la selección
                    } else {
                        alert("Error: " + res.error);
                    }
                } catch (error) {
                    console.error("Error:", error);
                }
            };
        }
        if (this.user) this.renderHome();
    }

    renderHome() {
        // Buscamos el contenedor principal para meter los botones
        const contenedor = document.querySelector('.contenedor__todo');
        if (contenedor) {
            contenedor.innerHTML = `
                <div style="text-align:center; color:white; padding:20px;">
                    <h2>Selecciona un Calendario</h2>
                    <div style="display:flex; flex-direction:column; gap:15px; margin-top:20px;">
                        <button onclick="location.href='calendario_nba.php'" style="padding:15px; cursor:pointer; background:#4facfe; border:none; border-radius:8px; color:white; font-weight:bold;">CALENDARIO NBA</button>
                        <button onclick="location.href='calendario_laliga.php'" style="padding:15px; cursor:pointer; background:#ff6b6b; border:none; border-radius:8px; color:white; font-weight:bold;">CALENDARIO LA LIGA</button>
                        <button onclick="sessionStorage.clear(); location.reload();" style="background:none; border:1px solid white; color:white; margin-top:10px; cursor:pointer;">Cerrar Sesión</button>
                    </div>
                </div>`;
        }
    }
}

const app = new App();