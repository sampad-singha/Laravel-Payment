import './App.css'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { AuthProvider, useAuth } from './contexts/AuthContext.jsx';
import GoogleLoginButton from "./GoogleLoginButton.jsx";
import Dashboard from "./Dashboard.jsx";

const PrivateRoute = ({ children }) => {
    const { userEmail } = useAuth();
    return userEmail ? children : <GoogleLoginButton />;
};
function App() {

  return (
      <AuthProvider>
          <Router>
              <Routes>
                  <Route path="/" element={<GoogleLoginButton />} />
                  <Route
                      path="/dashboard"
                      element={
                          <PrivateRoute>
                              <Dashboard />
                          </PrivateRoute>
                      }
                  />
                  <Route path="*" element={<h1>Page Not Found</h1>} />
              </Routes>
          </Router>
      </AuthProvider>
  )
}

export default App
