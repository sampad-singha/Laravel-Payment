// src/pages/Dashboard.jsx
import { useAuth } from './contexts/AuthContext.jsx';
import { Navigate } from 'react-router-dom';

const Dashboard = () => {
    const { userEmail } = useAuth();

    if (!userEmail) return <Navigate to="/login" />;

    return (
        <div>
            <h1>Welcome, {userEmail}</h1>
            <h3>{}</h3>
            {/* rest of your content */}
        </div>
    );
};

export default Dashboard;
