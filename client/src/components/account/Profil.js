// ProfileComponent.js
import React, { useState, useEffect } from "react";
import axios from "axios";
import Panier from "../articles/Panier";
import { useNavigate } from "react-router-dom";
import Nav from "../nav/Nav";
import Footer from "../footer/Footer";

const ProfileComponent = () => {
  const [userData, setUserData] = useState(null);
  const navigate = useNavigate();
  useEffect(() => {
    const fetchUserData = async () => {
      try {
        const token = localStorage.getItem("token");

        if (token) {
          console.log(token);
          const response = await axios.get(
            "http://localhost:8000/api/profile",
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );

          setUserData(response.data);
          console.log(response.data);
        } else {
          console.log("Aucun token trouvé.");
        }
      } catch (error) {
        console.log("Erreur lors de la récupération des données utilisateur");
      }
    };

    fetchUserData();
  }, []);

  const handleLogout = () => {
    // Supprimer le token du local storage
    localStorage.removeItem("token");
    navigate("/login");
    // Mettre à jour l'état pour effacer les données utilisateur
    setUserData(null);
  };

  return (
    <div>
      <Nav />
      {userData ? (
        <div>
          {/* <p>{userData.id}</p> */}
          {userData.admin == "ROLE_USER" ? (
            <h3>Salut a toi {userData.prenom} tu es un utilisateur </h3>
          ) : (
            <h3>Salut a toi {userData.prenom} tu es un administrateur</h3>
          )}
          <button onClick={handleLogout}>Se déconnecter</button>
      <button onClick={() => navigate("/Payment")}>
        Coordonnées bancaires
      </button>
      <button onClick={() => navigate("/Update")}>Modifier le profil</button>
        </div>
      ) : (
        <div>
        <p>Connectez-vous pour afficher les données du profil.</p>
        <button onClick={() => navigate("/register-form")}>Inscrit-toi</button>
        <button onClick={() => navigate("/login")}>Connecte-toi</button>
        </div>
      )}
      
    </div>
  );
};

export default ProfileComponent;
