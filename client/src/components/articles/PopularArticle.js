import React, { useState, useEffect } from "react";
import axios from "axios";
import Nav from "../nav/Nav";
import Slider from "../carousel/Slider";
import Footer from "../footer/Footer";

const PopularArticle = () => {
  const [articles, setArticles] = useState([]);
  const [userData, setUserData] = useState({
    nom: "",
    prenom: "",
    admin: [],
    id: null,
  });

  const fetchUserData = async () => {
    try {
      const token = localStorage.getItem("token");

      if (token) {
        const response = await axios.get(
          "http://localhost:8000/api/profile",
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setUserData(response.data);
      } else {
        console.log("Aucun token trouvé.");
      }
    } catch (error) {
      console.error(
        "Erreur lors de la récupération des données utilisateur :",
        error
      );
    }
  };

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/populararticle")
      .then((response) => {
        setArticles(response.data);
        console.log(response.data);
      })
      .catch((error) => {
        console.error(error);
      });

    fetchUserData();
  }, []); 

  return (
    <div>
      <Nav />
      <div className="carousel">
        <Slider />
      </div>

      <ol className="articles-list">
        {articles.map((article) => (
          <li key={article.id} className="article-item">
            <a href={`/article-details/${article.id}`} className="article-link">
              <div className="card">
                <img src={article.photo_url} alt={article.photo} />
                <div className="details">
                  <h3>{article.description}</h3>
                  <p className="price">${article.prix}</p>
                </div>
              </div>
            </a>
          </li>
        ))}
      </ol>
      <Footer />
    </div>
  );
};

export default PopularArticle;
