package com.example.myapplication;

import android.content.Context;
import android.content.Intent;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

public class quiz extends AppCompatActivity {

    TextView mTextView;

    private static final String EXTRA_PSEUDO = "com.example.myapplication.pseudo";
    private static final String EXTRA_NBQUESTIONS = "com.example.myapplication.nbQuestions";

    int mNbQuestions;
    String mPseudo;

    public static Intent newIntent(Context packageContext, String pseudo, int nbQuestions){
        Intent intent = new Intent(packageContext, quiz.class);

        intent.putExtra(EXTRA_PSEUDO, pseudo);
        intent.putExtra(EXTRA_NBQUESTIONS, nbQuestions);
        return intent;
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_quiz);

        mNbQuestions = getIntent().getIntExtra(EXTRA_NBQUESTIONS, 0);
        mPseudo = getIntent().getStringExtra(EXTRA_PSEUDO);

        mTextView = (TextView) findViewById(R.id.Test);
        mTextView.setText(mPseudo + mNbQuestions);
    }
}


