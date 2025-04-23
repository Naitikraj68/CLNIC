package com.clinicapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {
    Button btnPatient, btnDoctor, btnAdmin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btnPatient = findViewById(R.id.btnPatient);
        btnDoctor = findViewById(R.id.btnDoctor);
        btnAdmin = findViewById(R.id.btnAdmin);

        btnPatient.setOnClickListener(view -> startActivity(new Intent(this, PatientActivity.class)));
        btnDoctor.setOnClickListener(view -> startActivity(new Intent(this, DoctorActivity.class)));
        btnAdmin.setOnClickListener(view -> startActivity(new Intent(this, AdminActivity.class)));
    }
}