import Alpine from 'alpinejs';

window.Alpine = Alpine;

// ==========================================
// Mock Data & Auth Helpers
// ==========================================

const MOCK_CREDENTIALS = {
    email: 'admin@example.com',
    password: 'password',
    name: 'Administrator'
};

const INITIAL_PATIENTS = [
    { id: 1, nama: "Ahmad Fauzi", alamat: "Jl. Merdeka No. 10, Jakarta", umur: 35, noHP: "081234567890" },
    { id: 2, nama: "Siti Nurhaliza", alamat: "Jl. Sudirman No. 25, Bandung", umur: 28, noHP: "082345678901" },
    { id: 3, nama: "Budi Santoso", alamat: "Jl. Diponegoro No. 5, Surabaya", umur: 42, noHP: "083456789012" },
    { id: 4, nama: "Dewi Lestari", alamat: "Jl. Gatot Subroto No. 15, Semarang", umur: 31, noHP: "084567890123" },
    { id: 5, nama: "Rizky Pratama", alamat: "Jl. Ahmad Yani No. 8, Yogyakarta", umur: 25, noHP: "085678901234" },
    { id: 6, nama: "Putri Handayani", alamat: "Jl. Pahlawan No. 30, Malang", umur: 38, noHP: "086789012345" },
    { id: 7, nama: "Hendra Wijaya", alamat: "Jl. Imam Bonjol No. 12, Medan", umur: 50, noHP: "087890123456" },
    { id: 8, nama: "Anisa Rahma", alamat: "Jl. Kartini No. 7, Makassar", umur: 22, noHP: "088901234567" },
    { id: 9, nama: "Fajar Nugroho", alamat: "Jl. Veteran No. 20, Palembang", umur: 45, noHP: "089012345678" },
    { id: 10, nama: "Maya Sari", alamat: "Jl. Pemuda No. 3, Denpasar", umur: 33, noHP: "081123456789" }
];

// Initialize mock data if not exists
function initMockData() {
    if (!localStorage.getItem('patients')) {
        localStorage.setItem('patients', JSON.stringify(INITIAL_PATIENTS));
    }
}

// Auth helpers
window.AuthHelper = {
    login(email, password) {
        if (email === MOCK_CREDENTIALS.email && password === MOCK_CREDENTIALS.password) {
            const user = { email: MOCK_CREDENTIALS.email, name: MOCK_CREDENTIALS.name };
            localStorage.setItem('auth_user', JSON.stringify(user));
            localStorage.setItem('auth_token', 'mock-token-' + Date.now());
            return { success: true, user };
        }
        return { success: false, message: 'Email atau password salah!' };
    },
    logout() {
        localStorage.removeItem('auth_user');
        localStorage.removeItem('auth_token');
        window.location.href = '/login';
    },
    isAuthenticated() {
        return !!localStorage.getItem('auth_token');
    },
    getUser() {
        const user = localStorage.getItem('auth_user');
        return user ? JSON.parse(user) : null;
    }
};

// Patient CRUD helpers
window.PatientHelper = {
    getAll() {
        initMockData();
        return JSON.parse(localStorage.getItem('patients') || '[]');
    },
    getById(id) {
        const patients = this.getAll();
        return patients.find(p => p.id === parseInt(id));
    },
    create(patient) {
        const patients = this.getAll();
        const maxId = patients.length > 0 ? Math.max(...patients.map(p => p.id)) : 0;
        patient.id = maxId + 1;
        patients.push(patient);
        localStorage.setItem('patients', JSON.stringify(patients));
        return patient;
    },
    update(id, data) {
        const patients = this.getAll();
        const index = patients.findIndex(p => p.id === parseInt(id));
        if (index !== -1) {
            patients[index] = { ...patients[index], ...data, id: parseInt(id) };
            localStorage.setItem('patients', JSON.stringify(patients));
            return patients[index];
        }
        return null;
    },
    delete(id) {
        let patients = this.getAll();
        patients = patients.filter(p => p.id !== parseInt(id));
        localStorage.setItem('patients', JSON.stringify(patients));
    },
    search(query) {
        const patients = this.getAll();
        const q = query.toLowerCase();
        return patients.filter(p =>
            p.nama.toLowerCase().includes(q) ||
            p.alamat.toLowerCase().includes(q) ||
            p.noHP.includes(q)
        );
    },
    getStats() {
        const patients = this.getAll();
        const totalPatients = patients.length;
        const avgAge = patients.length > 0
            ? Math.round(patients.reduce((sum, p) => sum + p.umur, 0) / patients.length)
            : 0;
        const youngest = patients.length > 0
            ? Math.min(...patients.map(p => p.umur))
            : 0;
        const oldest = patients.length > 0
            ? Math.max(...patients.map(p => p.umur))
            : 0;
        return { totalPatients, avgAge, youngest, oldest };
    }
};

// Initialize data on load
initMockData();

// Auth guard - check on protected pages
window.checkAuth = function() {
    if (!window.AuthHelper.isAuthenticated()) {
        window.location.href = '/login';
        return false;
    }
    return true;
};

Alpine.start();
