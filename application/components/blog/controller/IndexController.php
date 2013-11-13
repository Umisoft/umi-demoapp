<?php
namespace application\components\blog\controller;

use application\components\blog\model\PostModel;
use umi\form\IFormAware;
use umi\form\TFormAware;
use umi\hmvc\component\request\IComponentRequest;
use umi\hmvc\context\IRouterContext;
use umi\hmvc\context\TRouterContext;
use umi\hmvc\controller\type\BaseController;
use umi\pagination\IPaginationAware;
use umi\pagination\TPaginationAware;

/**
 * Контроллер отображения списка постов блога.
 * @package App\Blog
 */
class IndexController extends BaseController implements IFormAware, IPaginationAware, IRouterContext
{
    use TFormAware;
    use TPaginationAware;
    use TRouterContext;

    /**
     * Количество выводимых постов на странице.
     */
    const POSTS_PER_PAGE = 3;

    /**
     * @var PostModel $postModel модель постов
     */
    protected $postModel;

    /**
     * Конструктор.
     * @param PostModel $postModel модель постов
     */
    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(IComponentRequest $request)
    {
        $deleteForm = $this->createForm(require dirname(__DIR__) . '/form/deletePost.php');
        $deleteForm->getAttributes()['action'] = $this->getContextRouter()
            ->assemble('deletePost');

        $posts = $this->postModel->getPosts();

        $paginator = $this->createPaginator($posts, self::POSTS_PER_PAGE);
        $paginator->setCurrentPage($request->getVar(IComponentRequest::ROUTE, 'page', 1));

        return $this->createControllerResult(
            'index',
            [
                'paginator'  => $paginator,
                'deleteForm' => $deleteForm
            ]
        );
    }
}
