<?php
namespace CustomFeedBack\FeedBackModule\Controller\Adminhtml\Post;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class View extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		Context $context,
		PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('CustomFeedBack_FeedBackModule::FeedBack');
		$resultPage->getConfig()->getTitle()->prepend((__('Feedbacks')));
		return $resultPage;
	}
}