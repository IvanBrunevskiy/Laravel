<h1>Hello World!!</h1>
<a href="{{route('Catalog_list')}}">Catalog page</a>

<?php
public function processItem($item) {
    $storage = $this->entityTypeManager->getStorage('node');
    $notification = $storage->load($item->entity_id);
    if (!$notification instanceof ContentEntityInterface) {
      return;
    }
    $date_string_time = DrupalDateTime::createFromTimestamp(time(), 'UTC');
    $date_string = $date_string_time->format(DateTimeItemInterface::DATETIME_STORAGE_FORMAT);
    $to_timestamp = strtotime($notification->get('field_sales_notification_date')->value);
    $get_datetime = DrupalDateTime::createFromTimestamp($to_timestamp, 'UTC');
    $datetime_difference = $date_string_time->diff($get_datetime)->d;
    if ($datetime_difference > 0) {
      $notification->set('field_sales_notification_date', $date_string);
      $answer = $notification->save();
      if ($answer > 0) {
        $message = new FormattableMarkup('The Notification with id - @id moved to today', ['@id' => $notification->id()]);
        $this->logger->notice($message);
      }
    }
  }
  $get_date = new DrupalDateTime($notification->get('field_sales_notification_date')->value);
    $to_timestamp = $get_date->getTimestamp();

function sales_module_select_outdated_notifications() {
  $current_time = date('Ymd');
  $query = \Drupal::database()->select('node_field_data', 'nfd');
  $query->join('node__field_notification_sales_user', 'nfsnu', 'nfsnu.entity_id=nfd.nid');
  $query->join('users_field_data', 'ufd', 'nfsnu.field_notification_sales_user_target_id=ufd.uid');
  $query->join('node__field_sales_notification_status', 'nfsns', 'nfsns.entity_id=nfd.nid');
  $query->join('node__field_sales_notification_date', 'nfsnd', 'nfsnd.entity_id=nfd.nid');
  $query->join('user__u_fired', 'uuf', 'ufd.uid = uuf.entity_id');
  $query->join('user__roles', 'ur', 'ur.entity_id=ufd.uid');
  $query->condition('nfsns.field_sales_notification_status_value', 'Open');
  $query->condition('nfd.status', 1);
  $query->condition('ufd.status', 1);
  $query->condition('ur.roles_target_id', 'sales_user', 'IN');
  $query->condition('uuf.u_fired_value', 0);
  $query->condition('nfd.type', 'sales_notification');
  $query->where("DATE_FORMAT(nfsnd.field_sales_notification_date_value, '%Y%m%d') < :time", [':time' => $current_time]);
  $query->fields('nfsnd', ['entity_id']);
  $query->range(0, 100);
  $result = $query->execute();
