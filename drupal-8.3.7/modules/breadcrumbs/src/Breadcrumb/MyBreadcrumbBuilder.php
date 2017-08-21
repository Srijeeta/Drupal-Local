<?php

namespace Drupal\breadcrumbs;

use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class MyBreadcrumbBuilder implements BreadcrumbBuilderInterface {
  use LinkGeneratorTrait;
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function applies(array $attributes) {
    if ($attributes['_route'] == 'node_page') {
      return $attributes['node']->bundle() == 'article';
    }
  }

  /**
   * {@inheritdoc}
   */
  public function build(array $attributes) {
    $breadcrumb = [Link::createFromRoute($this->t('Home'), '')];
    // Presumably this link has been defined elsewhere.
    $breadcrumb[] = Link::createFromRoute($this->t('Articles'), 'articles_route');
    // Breadcrumbs should not include the current page. The theme system
    // will take care of that.
    return $breadcrumb;
  }
}