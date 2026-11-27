package org.sem31.voisinage.models;

import android.graphics.Bitmap;

import java.time.LocalDateTime;
import java.util.List;

public class Annonce {
    private int id ;
    private User u;
    private Categorie c;
    private String titre;
    private String description;
    private String type_transaction;
    private String prix;
    private String etat_objet;
    private String disponibilite;
    private List<Bitmap> photos;
    private Localisation localisation;
    private String date_publication;

    public String getDate_publication() {
        return date_publication;
    }
    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setDate_publication(String date_publication) {
        this.date_publication = date_publication;
    }

    public Categorie getC() {
        return c;
    }

    public void setC(Categorie c) {
        this.c = c;
    }

    public String getDisponibilite() {
        return disponibilite;
    }

    public void setDisponibilite(String disponibilite) {
        this.disponibilite = disponibilite;
    }

    public String getEtat_objet() {
        return etat_objet;
    }

    public void setEtat_objet(String etat_objet) {
        this.etat_objet = etat_objet;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Localisation getLocalisation() {
        return localisation;
    }

    public void setLocalisation(Localisation localisation) {
        this.localisation = localisation;
    }

    public List<Bitmap> getPhotos() {
        return photos;
    }

    public void setPhotos(List<Bitmap> photos) {
        this.photos = photos;
    }

    public String getPrix() {
        return prix;
    }

    public void setPrix(String prix) {
        this.prix = prix;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public String getType_transaction() {
        return type_transaction;
    }

    public void setType_transaction(String type_transaction) {
        this.type_transaction = type_transaction;
    }

    public User getU() {
        return u;
    }

    public void setU(User u) {
        this.u = u;
    }
}
