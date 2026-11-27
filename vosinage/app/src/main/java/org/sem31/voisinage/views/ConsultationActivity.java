package org.sem31.voisinage.views;

import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import org.sem31.voisinage.R;
import org.sem31.voisinage.controllers.AnnonceController;
import org.sem31.voisinage.models.Annonce;
import org.sem31.voisinage.views.recyclerViewsAdapters.recyclerViewAdapterForItemAnnonce;

import java.util.Collections;
import java.util.List;

public class ConsultationActivity extends AppCompatActivity {
    ProgressBar progressBar;
    RecyclerView liste_dynamique;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.consultation_activity);
        progressBar=findViewById(R.id.progressBarAnnonces);
        liste_dynamique=findViewById(R.id.recyclerViewAnnonces);
        getAnnonceTask task=new getAnnonceTask();
        task.execute();
    }

    public class getAnnonceTask extends AsyncTask<Void,Integer, List<Annonce>>{
        @Override
        protected void onPreExecute() {
            progressBar.setVisibility(View.VISIBLE);
            progressBar.setProgress(0);
        }
        @Override
        protected void onPostExecute(List<Annonce> annonces) {
            progressBar.setProgress(100);
            progressBar.setVisibility(View.INVISIBLE);
            if(!annonces.isEmpty()){
                Toast.makeText(ConsultationActivity.this,"Annonces were successfully retrieved from database",Toast.LENGTH_SHORT).show();
                recyclerViewAdapterForItemAnnonce adapter=new recyclerViewAdapterForItemAnnonce(annonces);
                LinearLayoutManager manager=new LinearLayoutManager(ConsultationActivity.this,LinearLayoutManager.VERTICAL,false);
                liste_dynamique.setLayoutManager(manager);
                liste_dynamique.setAdapter(adapter);
            }
            else{
                Toast.makeText(ConsultationActivity.this,"An internal error has occured while retriving annonces from backend app",Toast.LENGTH_SHORT).show();
            }
        }
        @Override
        protected void onProgressUpdate(Integer... values) {
            progressBar.setProgress(values[0]);
        }

        @Override
        protected List<Annonce> doInBackground(Void... voids) {
            for(int i=0;i<10;i++){
                try{
                    Thread.sleep(1000);
                } catch (InterruptedException e) {
                    throw new RuntimeException(e);
                }
                publishProgress(i*10);
            }
            AnnonceController ac=new AnnonceController();
            List<Annonce> annonces=ac.getAnnonces();
            return annonces;
        }
    }
}