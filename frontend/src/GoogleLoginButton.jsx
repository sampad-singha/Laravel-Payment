// src/components/GoogleLoginButton.jsx
import { useAuth } from './contexts/AuthContext.jsx';

const GoogleLoginButton = () => {
    const { login } = useAuth();

    const handleGoogleLogin = () => {
        window.open(
            `${import.meta.env.VITE_BACKEND_URL}/auth/google/redirect`,
            '_blank',
            'width=500,height=600'
        );
        const listener = (event) => {
            if (!event.data || typeof event.data !== 'object') return;
            if (!event.data.token) return;

            localStorage.setItem('auth_token', event.data.token);
            localStorage.setItem('user_email', event.data.email);
            login(event.data.email);

            window.removeEventListener('message', listener);
            window.location.href = '/dashboard'; // redirect after login
        };

        window.addEventListener('message', listener);
    };

    return (
        <button onClick={handleGoogleLogin} className="btn btn-primary">
            Login with Google
        </button>
    );
};

export default GoogleLoginButton;
