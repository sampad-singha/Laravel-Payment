// src/context/AuthContext.jsx
import { createContext, useContext, useState } from 'react';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [userEmail, setUserEmail] = useState(localStorage.getItem('user_email') || null);

    const logout = () => {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_email');
        setUserEmail(null);
        window.location.href = '/login';
    };

    const login = (email) => {
        setUserEmail(email);
    };

    return (
        <AuthContext.Provider value={{ userEmail, login, logout }}>
            {children}
        </AuthContext.Provider>
    );
};

// eslint-disable-next-line react-refresh/only-export-components
export const useAuth = () => useContext(AuthContext);
