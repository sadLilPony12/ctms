<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Articles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
        [
            'avatar'  => 'article1.jpg',
            'title'   => 'Neutralizing-Antibody Therapy',
            'message' => 'In a phase 2 trial, outpatients with Covid-19 who received a single infusion of a 2800-mg dose of the neutralizing antibody LY-CoV555 had a greater reduction from baseline in viral load than those who received placebo. Hospitalization was less frequent among antibody-treated patients (1.6% vs. 6.3%).',
            'reference'=> 'www.nejm.org/coronavirus',
            'start_at'=> now(),
            'end_at'  => now(),
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],  
        [
            'avatar'  => 'stayHome.jpeg',
            'title'   => 'Remdesivir for the Treatment',
            'message' => 'We conducted a double-blind, randomized, placebo-controlled trial of intravenous remdesivir in adults who were hospitalized with Covid-19 and had evidence of lower respiratory tract infection. Patients were randomly assigned to receive either remdesivir (200 mg loading dose on day 1, followed by 100 mg daily for up to 9 additional days) or placebo for up to 10 days. The primary outcome was the time to recovery, defined by either discharge from the hospital or hospitalization for infection-control purposes only.',
            'reference'=> 'www.nejm.org/doi/full/10.1056/NEJMoa2007764',
            'start_at'=> now(),
            'end_at'  => now(),
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
          'avatar'  => 'article2.jpg',
          'title'   => 'COVID-19 Research',
          'message' => 'As communities around the world respond to the rapidly evolving situation around COVID-19, psychologists across the breadth of the field are providing critical guidance and support. APA Publishing is grateful for your leadership and is committed to providing you with the resources you need to carry out your work.',
          'reference'=> 'www.apa.org/pubs/highlights/covid-19-articles',
          'start_at'=> now(),
          'end_at'  => now(),
          'user_id' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'avatar'  => 'stayHome.jpeg',
          'title'   => 'Dexamethasone in Hospitalized Patients',
          'message' => 'Coronavirus disease 2019 (Covid-19) is associated with diffuse lung damage. Glucocorticoids may modulate inflammation-mediated lung injury and thereby reduce progression to respiratory failure and death.',
          'reference'=> 'www.nejm.org/doi/full/10.1056/NEJMoa2021436',
          'start_at'=> now(),
          'end_at'  => now(),
          'user_id' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ]
      ]);
    }
}
