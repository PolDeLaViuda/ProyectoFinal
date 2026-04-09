// Main application logic



class App {

    constructor() {
        this.currentView = 'login';
        this.currentMonth = new Date().getMonth(); // 0-11
        this.currentYear = new Date().getFullYear();
        this.inactivityTimer = null;
        this.inactivityTimeout = 10000; // 10 segundos en milisegundos
        this.setupInactivityDetection();
        this.render();
    }



    setupInactivityDetection() {

        // Eventos que indican actividad del usuario

        const events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];
        events.forEach(event => {
            document.addEventListener(event, () => {
                this.resetInactivityTimer();
            }, true);
        });
    }



    resetInactivityTimer() {

        // Solo iniciar el temporizador si el usuario está autenticado

        if (!auth.isAuthenticated()) {
            return;
        }



        // Limpiar el temporizador anterior

        if (this.inactivityTimer) {
            clearTimeout(this.inactivityTimer);
        }



        // Iniciar nuevo temporizador

        this.inactivityTimer = setTimeout(() => {
            this.handleInactivityLogout();
        }, this.inactivityTimeout);
    }



    handleInactivityLogout() {
        if (auth.isAuthenticated()) {
            auth.logout();
            alert('Tu sesión ha sido cerrada por inactividad');
            this.navigate('login');
        }
    }



    navigate(view) {
        this.currentView = view;
        if (view === 'laliga' || view === 'nba') {
            this.currentMonth = new Date().getMonth();
            this.currentYear = new Date().getFullYear();
        }


        this.render();
    }



    render() {
        const app = document.getElementById('app');

       

        // Check authentication for protected routes

        if (!auth.isAuthenticated() && ['home', 'laliga', 'nba'].includes(this.currentView)) {
            this.currentView = 'login';
        }



        switch(this.currentView) {
            case 'login':
                app.innerHTML = this.renderLogin();
                this.attachLoginEvents();
                break;
            case 'register':
                app.innerHTML = this.renderRegister();
                this.attachRegisterEvents();
                break;
            case 'home':
                app.innerHTML = this.renderHome();
                this.attachHomeEvents();
                break;
            case 'laliga':
                app.innerHTML = this.renderLaLigaCalendar();
                this.attachCalendarEvents('laliga');
                break;
            case 'nba':
                app.innerHTML = this.renderNBACalendar();
                this.attachCalendarEvents('nba');
                break;
        }
    }



    renderLogin() {
        return `
            <div class="auth-container">
                <h1 class="auth-title">Bienvenido</h1>
                <p class="auth-subtitle">Inicia sesión para acceder a los calendarios deportivos</p>
                <form id="loginForm">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            class="form-input"
                            placeholder="tu@email.com"
                            required
                        />
                    </div>

                   

                    <div class="form-group">
                        <label class="form-label" for="password">Contraseña</label>
                        <input
                            type="password"
                            id="password"
                            class="form-input"
                            placeholder="••••••••"
                            required
                        />
                    </div>

                   

                    <div id="loginError" style="color: #c53030; font-size: 14px; margin-bottom: 16px; display: none;"></div>

                    <button type="submit" class="btn btn-primary">
                        Iniciar Sesión
                    </button>
                </form>


                <div class="auth-link">
                    ¿No tienes cuenta? <a href="#" id="goToRegister">Regístrate aquí</a>
                </div>
            </div>
        `;
    }



    renderRegister() {
        return `
            <div class="auth-container">
                <h1 class="auth-title">Crear Cuenta</h1>
                <p class="auth-subtitle">Regístrate para acceder a los calendarios deportivos</p>

                <form id="registerForm">
                    <div class="form-group">
                        <label class="form-label" for="name">Nombre Completo</label>
                        <input
                            type="text"
                            id="name"
                            class="form-input"
                            placeholder="Juan Pérez"
                            required
                        />
                    </div>

                   
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            class="form-input"
                            placeholder="tu@email.com"
                            required
                        />
                    </div>

                
                    <div class="form-group">
                        <label class="form-label" for="password">Contraseña</label>
                        <input
                            type="password"
                            id="password"
                            class="form-input"
                            placeholder="••••••••"
                            required
                            minlength="6"
                        />
                    </div>

                    <div id="registerError" style="color: #c53030; font-size: 14px; margin-bottom: 16px; display: none;"></div>
                   

                    <button type="submit" class="btn btn-primary">
                        Crear Cuenta
                    </button>
                </form>


                <div class="auth-link">
                    ¿Ya tienes cuenta? <a href="#" id="goToLogin">Inicia sesión aquí</a>
                </div>
            </div>
        `;
    }



    renderHome() {
        const user = auth.getCurrentUser();
        return `
            <div class="home-container">
                <h1 class="home-title">Calendarios Deportivos</h1>
                <p class="home-subtitle">Hola ${user.name}, selecciona el calendario que deseas ver</p>
               

                <div class="calendar-buttons">
                    <button class="calendar-btn calendar-btn-laliga" id="goToLaLiga">
                        <svg class="icon" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 2 L12 22 M2 12 L22 12" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Liga Española
                    </button>

                
                    <button class="calendar-btn calendar-btn-nba" id="goToNBA">
                        <svg class="icon" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="12" r="3" fill="currentColor"/>
                        </svg>
                        NBA
                    </button>
                </div>


                <button class="btn btn-secondary" id="logoutBtn">
                    Cerrar Sesión
                </button>
            </div>
        `;
    }



    renderLaLigaCalendar() {
        const matches = this.filterMatchesByMonth(laLigaMatches);
        return this.renderCalendar('Liga Española', matches, 'laliga');
    }


    renderNBACalendar() {
        const matches = this.filterMatchesByMonth(nbaMatches);
        return this.renderCalendar('NBA', matches, 'nba');
    }


    renderCalendar(title, matches, type) {
        const matchCards = matches.length > 0
            ? matches.map(match => this.renderMatchCard(match)).join('')
            : '<div class="no-matches">No hay partidos en este mes</div>';


        return `
            <div class="calendar-container">
                <div class="calendar-header">
                    <h1 class="calendar-title">${title}</h1>
                    <div class="header-buttons">
                        <button class="btn-small btn-back" id="backToHome">
                            ← Volver
                        </button>
                        <button class="btn-small btn-logout" id="logoutBtn">
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
               

                <div class="month-navigation">
                    <button class="nav-btn" id="prevMonth">← Anterior</button>
                    <h2 class="month-title">${MONTHS[this.currentMonth]} ${this.currentYear}</h2>
                    <button class="nav-btn" id="nextMonth">Siguiente →</button>
                </div>
               

                <div class="calendar-grid">
                    ${matchCards}
                </div>
            </div>
        `;
    }


    renderMatchCard(match) {
        return `
            <div class="match-card">
                <div class="match-date">${this.formatDate(match.date)}</div>
                <div class="match-teams">
                    <span class="team">${match.homeTeam}</span>
                    <span class="vs">vs</span>
                    <span class="team">${match.awayTeam}</span>
                </div>
                <div class="match-info">
                    <span>🕐 ${match.time}</span>
                    <span>📍 ${match.stadium}</span>
                </div>
               

                <div class="probabilities">
                    <div class="prob-header">
                        <div class="prob-team">
                            <span>${match.homeTeam}</span>
                            <span class="prob-value" style="color: #667eea;">${match.homeProbability}%</span>
                        </div>

                        <div class="prob-team">
                            <span class="prob-value" style="color: #f5576c;">${match.awayProbability}%</span>
                            <span>${match.awayTeam}</span>
                        </div>
                    </div>
                    <div class="prob-bar">
                        <div class="prob-fill-home" style="width: ${match.homeProbability}%"></div>
                        <div class="prob-fill-away" style="width: ${match.awayProbability}%"></div>
                    </div>
                </div>
            </div>
        `;
    }


    filterMatchesByMonth(matches) {
        return matches.filter(match => {
            const matchDate = new Date(match.date);
            return matchDate.getMonth() === this.currentMonth &&
                   matchDate.getFullYear() === this.currentYear;
        });
    }


    formatDate(dateString) {
        const date = new Date(dateString);
        const days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        const dayName = days[date.getDay()];
        const day = date.getDate();
        const month = MONTHS[date.getMonth()];
        return `${dayName}, ${day} de ${month}`;
    }


    attachLoginEvents() {
        const form = document.getElementById('loginForm');
        const goToRegister = document.getElementById('goToRegister');
       

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
           

            const result = auth.login(email, password);
            if (result.success) {
                this.navigate('home');
            } else {
                const errorDiv = document.getElementById('loginError');
                errorDiv.textContent = result.error;
                errorDiv.style.display = 'block';
            }
        });


        goToRegister.addEventListener('click', (e) => {
            e.preventDefault();
            this.navigate('register');
        });
    }


    attachRegisterEvents() {
        const form = document.getElementById('registerForm');
        const goToLogin = document.getElementById('goToLogin');
       
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
           

            const result = auth.register(name, email, password);
            if (result.success) {
                this.navigate('home');
            } else {
                const errorDiv = document.getElementById('registerError');
                errorDiv.textContent = result.error;
                errorDiv.style.display = 'block';
            }
        });


        goToLogin.addEventListener('click', (e) => {
            e.preventDefault();
            this.navigate('login');
        });
    }


    attachHomeEvents() {
        document.getElementById('goToLaLiga').addEventListener('click', () => {
            this.navigate('laliga');
        });


        document.getElementById('goToNBA').addEventListener('click', () => {
            this.navigate('nba');
        });


        document.getElementById('logoutBtn').addEventListener('click', () => {
            auth.logout();
            this.navigate('login');
        });
    }


    attachCalendarEvents(type) {
        document.getElementById('backToHome').addEventListener('click', () => {
            this.navigate('home');
        });


        document.getElementById('logoutBtn').addEventListener('click', () => {
            auth.logout();
            this.navigate('login');
        });


        document.getElementById('prevMonth').addEventListener('click', () => {
            this.currentMonth--;
            if (this.currentMonth < 0) {
                this.currentMonth = 11;
                this.currentYear--;
            }
            this.navigate(type);
        });


        document.getElementById('nextMonth').addEventListener('click', () => {
            this.currentMonth++;
            if (this.currentMonth > 11) {
                this.currentMonth = 0;
                this.currentYear++;
            }
            this.navigate(type);
        });
    }
}


// Initialize the app when DOM is ready

document.addEventListener('DOMContentLoaded', () => {
    new App();
});

