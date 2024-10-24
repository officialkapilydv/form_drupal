<?php
namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a custom form for questions and answers.
 */
class MyForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_form_id';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['question'] = [
      '#title' => $this->t('Question'),
      '#type' => 'textfield',
      '#size' => 50,
      '#required' => TRUE,
      '#description' => $this->t('Enter your question here.'),
    ];

    $form['answer'] = [
      '#title' => $this->t('Answer'),
      '#type' => 'textarea',
      '#size' => 200,
      '#required' => TRUE,
      '#description' => $this->t('Enter your answer here.'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

/**
 * {@inheritdoc}
 */
public function submitForm(array &$form, FormStateInterface $form_state) {
    // Get the submitted values.
    $question = $form_state->getValue('question');
    $answer = $form_state->getValue('answer');
    
    // Insert into the custom table.
    \Drupal::database()->insert('mymodule_questions')
      ->fields([
        'question' => $question,
        'answer' => $answer,
        'created' => \Drupal::time()->getRequestTime(),
      ])
      ->execute();
  
    // Display a confirmation message.
    \Drupal::messenger()->addMessage('Form submitted successfully. Question: ' . $question . ' Answer: ' . $answer);
    
    // Redirect to the page that displays the data.
    $form_state->setRedirect('mymodule.display_data');
  }
  
}
