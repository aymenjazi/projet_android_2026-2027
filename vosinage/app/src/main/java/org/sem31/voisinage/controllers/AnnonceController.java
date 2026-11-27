package org.sem31.voisinage.controllers;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;

import org.json.JSONArray;
import org.json.JSONObject;
import org.sem31.voisinage.models.Annonce;
import org.sem31.voisinage.models.Categorie;
import org.sem31.voisinage.models.Localisation;
import org.sem31.voisinage.models.User;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

public class AnnonceController {
    public List<Annonce> getAnnonces(){
       List<Annonce> annonces=new ArrayList<Annonce>();
        URL url =null;
        try {
            url = new URL("http://192.168.1.11:8000/annonce/get_annonces");
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setDoInput(true);
            connection.connect();
            if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                InputStream inputStream = connection.getInputStream();
                BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream));
                StringBuilder result = new StringBuilder();
                String line = reader.readLine();
                while (line != null) {
                    result.append(line);
                    line = reader.readLine();
                }
                JSONArray jsonArray = new JSONArray(result.toString());
                for(int i=0;i<jsonArray.length();i++){
                    JSONObject objet=jsonArray.getJSONObject(i);
                    Annonce a=new Annonce();
                    a.setId((int)objet.get("id"));
                    a.setDate_publication(objet.getString("datePublication"));
                    a.setTitre((String) objet.get("titre"));
                    a.setEtat_objet(objet.getString("etatObjet"));
                    a.setDescription(objet.getString("description"));
                    a.setDisponibilite(objet.getString("disponibilite"));
                    a.setType_transaction(objet.getString("typeTransaction"));
                    a.setPrix(objet.getString("prix"));
                    User u=new User();
                    JSONObject objet_user=(JSONObject)objet.get("user");
                    u.setId(objet_user.getInt("id"));
                    u.setNom(objet_user.getString("nom"));
                    u.setPrenom(objet_user.getString("prenom"));
                    u.setEmail(objet_user.getString("email"));
                    u.setLogin(objet_user.getString("login"));
                    u.setMotDePasseHash(objet_user.getString("motDePasseHash"));
                    u.setTelephone(objet_user.getString("telephone"));
                    u.setPhoto(objet_user.getString("photo"));
                    u.setRole(objet_user.getString("role"));
                    a.setU(u);
                    Categorie c=new Categorie();
                    JSONObject objet_categorie=(JSONObject)objet.get("categorie");
                    c.setId(objet_categorie.getInt("id"));
                    c.setLibelle(objet_categorie.getString("libelle"));
                    a.setC(c);
                    Localisation l=new Localisation();
                    JSONObject objet_localisation=(JSONObject)objet.get("localisation");
                    l.setId(objet_localisation.getInt("id"));
                    l.setVille(objet_localisation.getString("ville"));
                    l.setQuartier(objet_localisation.getString("quartier"));
                    l.setLongitude(objet_localisation.getString("longitude"));
                    l.setLatitude(objet_localisation.getString("latitude"));
                    a.setLocalisation(l);
                    url=new URL("http://192.168.1.11:8000/photoAnnonce/"+String.valueOf(a.getId())+"/get_photoAnnonces");
                    connection = (HttpURLConnection) url.openConnection();
                    connection.setDoInput(true);
                    connection.connect();
                    if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                        inputStream = connection.getInputStream();
                        reader = new BufferedReader(new InputStreamReader(inputStream));
                        result = new StringBuilder();
                        line = reader.readLine();
                        while (line != null) {
                            result.append(line);
                            line = reader.readLine();
                        }
                        jsonArray = new JSONArray(result.toString());
                        List<Bitmap> images_annonces=new ArrayList<Bitmap>();
                        for(int j=0;j<jsonArray.length();j++){
                            url=new URL("http://192.168.1.11:8000"+jsonArray.getJSONObject(i).getString("urlPhoto"));
                            connection = (HttpURLConnection) url.openConnection();
                            connection.setDoInput(true);
                            connection.connect();
                            if (connection.getResponseCode() == HttpURLConnection.HTTP_OK) {
                                inputStream = connection.getInputStream();
                                Bitmap bitmap = BitmapFactory.decodeStream(inputStream);
                                images_annonces.add(bitmap);
                            }
                        }
                        a.setPhotos(images_annonces);
                    }
                    annonces.add(a);
                }
            }
            }catch (Exception e){
                e.printStackTrace();
            }
            return annonces;
    }
}
