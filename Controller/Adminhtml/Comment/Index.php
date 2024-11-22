<?php
declare(strict_types=1);

namespace Valerii\Comment\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Valerii_Comment::management_view';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Valerii_Comment::management_view');
        $resultPage->addBreadcrumb(__('Comment'), __('Comment'));
        $resultPage->addBreadcrumb(__('Manage Comments'), __('Manage Comments'));
        $resultPage->getConfig()->getTitle()->prepend(__('Comment List'));

        return $resultPage;
    }
}
