package org.sem31.voisinage.views.recyclerViewsAdapters;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import org.sem31.voisinage.R;
import org.sem31.voisinage.models.Annonce;

import java.util.List;

public class recyclerViewAdapterForItemAnnonce extends RecyclerView.Adapter<recyclerViewAdapterForItemAnnonce.myViewHolder> {
    private List<Annonce> annonces;

    public recyclerViewAdapterForItemAnnonce(List<Annonce> annonces) {
        this.annonces = annonces;
    }

    @NonNull
    @Override
    public myViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View v= LayoutInflater.from(parent.getContext()).inflate(R.layout.item_annonce,parent,false);
        return new myViewHolder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull myViewHolder holder, int position) {
        Annonce a=annonces.get(position);
        holder.img.setImageBitmap(a.getPhotos().get(0));
        holder.titre_annonce.setText(a.getTitre());
        holder.prix_item.setText(a.getPrix());
        holder.categorie.setText(a.getC().getLibelle());
        holder.type_transaction.setText(a.getType_transaction());
        holder.etat_et_localisation.setText(a.getLocalisation().getVille()+"/"+a.getLocalisation().getQuartier());
    }

    @Override
    public int getItemCount() {
        return annonces.size();
    }

    public class myViewHolder extends RecyclerView.ViewHolder{
        ImageView img;
        TextView titre_annonce,prix_item,categorie,type_transaction,etat_et_localisation;
        public myViewHolder(@NonNull View itemView) {
            super(itemView);
            img=itemView.findViewById(R.id.ivPhotoAnnonce);
            titre_annonce=itemView.findViewById(R.id.tvTitreAnnonce);
            prix_item=itemView.findViewById(R.id.tvPrixAnnonce);
            categorie=itemView.findViewById(R.id.tvCategorieAnnonce);
            type_transaction=itemView.findViewById(R.id.tvTransactionAnnonce);
            etat_et_localisation=itemView.findViewById(R.id.tvEtatLocalisation);
        }
    }
}
