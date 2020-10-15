<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/automl/v1/model_evaluation.proto

namespace Google\Cloud\AutoMl\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Evaluation results of a model.
 *
 * Generated from protobuf message <code>google.cloud.automl.v1.ModelEvaluation</code>
 */
class ModelEvaluation extends \Google\Protobuf\Internal\Message
{
    /**
     * Output only. Resource name of the model evaluation.
     * Format:
     * `projects/{project_id}/locations/{location_id}/models/{model_id}/modelEvaluations/{model_evaluation_id}`
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * Output only. The ID of the annotation spec that the model evaluation applies to. The
     * The ID is empty for the overall model evaluation.
     * For Tables annotation specs in the dataset do not exist and this ID is
     * always not set, but for CLASSIFICATION
     * [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     * the
     * [display_name][google.cloud.automl.v1.ModelEvaluation.display_name]
     * field is used.
     *
     * Generated from protobuf field <code>string annotation_spec_id = 2;</code>
     */
    private $annotation_spec_id = '';
    /**
     * Output only. The value of
     * [display_name][google.cloud.automl.v1.AnnotationSpec.display_name]
     * at the moment when the model was trained. Because this field returns a
     * value at model training time, for different models trained from the same
     * dataset, the values may differ, since display names could had been changed
     * between the two model's trainings. For Tables CLASSIFICATION
     * [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     * distinct values of the target column at the moment of the model evaluation
     * are populated here.
     * The display_name is empty for the overall model evaluation.
     *
     * Generated from protobuf field <code>string display_name = 15;</code>
     */
    private $display_name = '';
    /**
     * Output only. Timestamp when this model evaluation was created.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp create_time = 5;</code>
     */
    private $create_time = null;
    /**
     * Output only. The number of examples used for model evaluation, i.e. for
     * which ground truth from time of model creation is compared against the
     * predicted annotations created by the model.
     * For overall ModelEvaluation (i.e. with annotation_spec_id not set) this is
     * the total number of all examples used for evaluation.
     * Otherwise, this is the count of examples that according to the ground
     * truth were annotated by the
     * [annotation_spec_id][google.cloud.automl.v1.ModelEvaluation.annotation_spec_id].
     *
     * Generated from protobuf field <code>int32 evaluated_example_count = 6;</code>
     */
    private $evaluated_example_count = 0;
    protected $metrics;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\AutoMl\V1\ClassificationEvaluationMetrics $classification_evaluation_metrics
     *           Model evaluation metrics for image, text, video and tables
     *           classification.
     *           Tables problem is considered a classification when the target column
     *           is CATEGORY DataType.
     *     @type \Google\Cloud\AutoMl\V1\TranslationEvaluationMetrics $translation_evaluation_metrics
     *           Model evaluation metrics for translation.
     *     @type \Google\Cloud\AutoMl\V1\ImageObjectDetectionEvaluationMetrics $image_object_detection_evaluation_metrics
     *           Model evaluation metrics for image object detection.
     *     @type \Google\Cloud\AutoMl\V1\TextSentimentEvaluationMetrics $text_sentiment_evaluation_metrics
     *           Evaluation metrics for text sentiment models.
     *     @type \Google\Cloud\AutoMl\V1\TextExtractionEvaluationMetrics $text_extraction_evaluation_metrics
     *           Evaluation metrics for text extraction models.
     *     @type string $name
     *           Output only. Resource name of the model evaluation.
     *           Format:
     *           `projects/{project_id}/locations/{location_id}/models/{model_id}/modelEvaluations/{model_evaluation_id}`
     *     @type string $annotation_spec_id
     *           Output only. The ID of the annotation spec that the model evaluation applies to. The
     *           The ID is empty for the overall model evaluation.
     *           For Tables annotation specs in the dataset do not exist and this ID is
     *           always not set, but for CLASSIFICATION
     *           [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     *           the
     *           [display_name][google.cloud.automl.v1.ModelEvaluation.display_name]
     *           field is used.
     *     @type string $display_name
     *           Output only. The value of
     *           [display_name][google.cloud.automl.v1.AnnotationSpec.display_name]
     *           at the moment when the model was trained. Because this field returns a
     *           value at model training time, for different models trained from the same
     *           dataset, the values may differ, since display names could had been changed
     *           between the two model's trainings. For Tables CLASSIFICATION
     *           [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     *           distinct values of the target column at the moment of the model evaluation
     *           are populated here.
     *           The display_name is empty for the overall model evaluation.
     *     @type \Google\Protobuf\Timestamp $create_time
     *           Output only. Timestamp when this model evaluation was created.
     *     @type int $evaluated_example_count
     *           Output only. The number of examples used for model evaluation, i.e. for
     *           which ground truth from time of model creation is compared against the
     *           predicted annotations created by the model.
     *           For overall ModelEvaluation (i.e. with annotation_spec_id not set) this is
     *           the total number of all examples used for evaluation.
     *           Otherwise, this is the count of examples that according to the ground
     *           truth were annotated by the
     *           [annotation_spec_id][google.cloud.automl.v1.ModelEvaluation.annotation_spec_id].
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Automl\V1\ModelEvaluation::initOnce();
        parent::__construct($data);
    }

    /**
     * Model evaluation metrics for image, text, video and tables
     * classification.
     * Tables problem is considered a classification when the target column
     * is CATEGORY DataType.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.ClassificationEvaluationMetrics classification_evaluation_metrics = 8;</code>
     * @return \Google\Cloud\AutoMl\V1\ClassificationEvaluationMetrics
     */
    public function getClassificationEvaluationMetrics()
    {
        return $this->readOneof(8);
    }

    /**
     * Model evaluation metrics for image, text, video and tables
     * classification.
     * Tables problem is considered a classification when the target column
     * is CATEGORY DataType.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.ClassificationEvaluationMetrics classification_evaluation_metrics = 8;</code>
     * @param \Google\Cloud\AutoMl\V1\ClassificationEvaluationMetrics $var
     * @return $this
     */
    public function setClassificationEvaluationMetrics($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\ClassificationEvaluationMetrics::class);
        $this->writeOneof(8, $var);

        return $this;
    }

    /**
     * Model evaluation metrics for translation.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.TranslationEvaluationMetrics translation_evaluation_metrics = 9;</code>
     * @return \Google\Cloud\AutoMl\V1\TranslationEvaluationMetrics
     */
    public function getTranslationEvaluationMetrics()
    {
        return $this->readOneof(9);
    }

    /**
     * Model evaluation metrics for translation.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.TranslationEvaluationMetrics translation_evaluation_metrics = 9;</code>
     * @param \Google\Cloud\AutoMl\V1\TranslationEvaluationMetrics $var
     * @return $this
     */
    public function setTranslationEvaluationMetrics($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\TranslationEvaluationMetrics::class);
        $this->writeOneof(9, $var);

        return $this;
    }

    /**
     * Model evaluation metrics for image object detection.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.ImageObjectDetectionEvaluationMetrics image_object_detection_evaluation_metrics = 12;</code>
     * @return \Google\Cloud\AutoMl\V1\ImageObjectDetectionEvaluationMetrics
     */
    public function getImageObjectDetectionEvaluationMetrics()
    {
        return $this->readOneof(12);
    }

    /**
     * Model evaluation metrics for image object detection.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.ImageObjectDetectionEvaluationMetrics image_object_detection_evaluation_metrics = 12;</code>
     * @param \Google\Cloud\AutoMl\V1\ImageObjectDetectionEvaluationMetrics $var
     * @return $this
     */
    public function setImageObjectDetectionEvaluationMetrics($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\ImageObjectDetectionEvaluationMetrics::class);
        $this->writeOneof(12, $var);

        return $this;
    }

    /**
     * Evaluation metrics for text sentiment models.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.TextSentimentEvaluationMetrics text_sentiment_evaluation_metrics = 11;</code>
     * @return \Google\Cloud\AutoMl\V1\TextSentimentEvaluationMetrics
     */
    public function getTextSentimentEvaluationMetrics()
    {
        return $this->readOneof(11);
    }

    /**
     * Evaluation metrics for text sentiment models.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.TextSentimentEvaluationMetrics text_sentiment_evaluation_metrics = 11;</code>
     * @param \Google\Cloud\AutoMl\V1\TextSentimentEvaluationMetrics $var
     * @return $this
     */
    public function setTextSentimentEvaluationMetrics($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\TextSentimentEvaluationMetrics::class);
        $this->writeOneof(11, $var);

        return $this;
    }

    /**
     * Evaluation metrics for text extraction models.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.TextExtractionEvaluationMetrics text_extraction_evaluation_metrics = 13;</code>
     * @return \Google\Cloud\AutoMl\V1\TextExtractionEvaluationMetrics
     */
    public function getTextExtractionEvaluationMetrics()
    {
        return $this->readOneof(13);
    }

    /**
     * Evaluation metrics for text extraction models.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.TextExtractionEvaluationMetrics text_extraction_evaluation_metrics = 13;</code>
     * @param \Google\Cloud\AutoMl\V1\TextExtractionEvaluationMetrics $var
     * @return $this
     */
    public function setTextExtractionEvaluationMetrics($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\TextExtractionEvaluationMetrics::class);
        $this->writeOneof(13, $var);

        return $this;
    }

    /**
     * Output only. Resource name of the model evaluation.
     * Format:
     * `projects/{project_id}/locations/{location_id}/models/{model_id}/modelEvaluations/{model_evaluation_id}`
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Output only. Resource name of the model evaluation.
     * Format:
     * `projects/{project_id}/locations/{location_id}/models/{model_id}/modelEvaluations/{model_evaluation_id}`
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Output only. The ID of the annotation spec that the model evaluation applies to. The
     * The ID is empty for the overall model evaluation.
     * For Tables annotation specs in the dataset do not exist and this ID is
     * always not set, but for CLASSIFICATION
     * [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     * the
     * [display_name][google.cloud.automl.v1.ModelEvaluation.display_name]
     * field is used.
     *
     * Generated from protobuf field <code>string annotation_spec_id = 2;</code>
     * @return string
     */
    public function getAnnotationSpecId()
    {
        return $this->annotation_spec_id;
    }

    /**
     * Output only. The ID of the annotation spec that the model evaluation applies to. The
     * The ID is empty for the overall model evaluation.
     * For Tables annotation specs in the dataset do not exist and this ID is
     * always not set, but for CLASSIFICATION
     * [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     * the
     * [display_name][google.cloud.automl.v1.ModelEvaluation.display_name]
     * field is used.
     *
     * Generated from protobuf field <code>string annotation_spec_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setAnnotationSpecId($var)
    {
        GPBUtil::checkString($var, True);
        $this->annotation_spec_id = $var;

        return $this;
    }

    /**
     * Output only. The value of
     * [display_name][google.cloud.automl.v1.AnnotationSpec.display_name]
     * at the moment when the model was trained. Because this field returns a
     * value at model training time, for different models trained from the same
     * dataset, the values may differ, since display names could had been changed
     * between the two model's trainings. For Tables CLASSIFICATION
     * [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     * distinct values of the target column at the moment of the model evaluation
     * are populated here.
     * The display_name is empty for the overall model evaluation.
     *
     * Generated from protobuf field <code>string display_name = 15;</code>
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Output only. The value of
     * [display_name][google.cloud.automl.v1.AnnotationSpec.display_name]
     * at the moment when the model was trained. Because this field returns a
     * value at model training time, for different models trained from the same
     * dataset, the values may differ, since display names could had been changed
     * between the two model's trainings. For Tables CLASSIFICATION
     * [prediction_type-s][google.cloud.automl.v1.TablesModelMetadata.prediction_type]
     * distinct values of the target column at the moment of the model evaluation
     * are populated here.
     * The display_name is empty for the overall model evaluation.
     *
     * Generated from protobuf field <code>string display_name = 15;</code>
     * @param string $var
     * @return $this
     */
    public function setDisplayName($var)
    {
        GPBUtil::checkString($var, True);
        $this->display_name = $var;

        return $this;
    }

    /**
     * Output only. Timestamp when this model evaluation was created.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp create_time = 5;</code>
     * @return \Google\Protobuf\Timestamp
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Output only. Timestamp when this model evaluation was created.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp create_time = 5;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setCreateTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->create_time = $var;

        return $this;
    }

    /**
     * Output only. The number of examples used for model evaluation, i.e. for
     * which ground truth from time of model creation is compared against the
     * predicted annotations created by the model.
     * For overall ModelEvaluation (i.e. with annotation_spec_id not set) this is
     * the total number of all examples used for evaluation.
     * Otherwise, this is the count of examples that according to the ground
     * truth were annotated by the
     * [annotation_spec_id][google.cloud.automl.v1.ModelEvaluation.annotation_spec_id].
     *
     * Generated from protobuf field <code>int32 evaluated_example_count = 6;</code>
     * @return int
     */
    public function getEvaluatedExampleCount()
    {
        return $this->evaluated_example_count;
    }

    /**
     * Output only. The number of examples used for model evaluation, i.e. for
     * which ground truth from time of model creation is compared against the
     * predicted annotations created by the model.
     * For overall ModelEvaluation (i.e. with annotation_spec_id not set) this is
     * the total number of all examples used for evaluation.
     * Otherwise, this is the count of examples that according to the ground
     * truth were annotated by the
     * [annotation_spec_id][google.cloud.automl.v1.ModelEvaluation.annotation_spec_id].
     *
     * Generated from protobuf field <code>int32 evaluated_example_count = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setEvaluatedExampleCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->evaluated_example_count = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetrics()
    {
        return $this->whichOneof("metrics");
    }

}

